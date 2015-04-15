<?php

class InstallController extends Controller
{
	public function actionIndex()
	{
        $caption = array();
        $caption['installed'] = $this->checkModuleInstalled();
		$this->render('index',$caption);
	}
    
    public function actionInstallDatabase()
    {
        $db = Yii::app()->getDb();
        
        $tableName = $this->getTableName();
        
        $createTable = new CDbCommand($db,"
        CREATE TABLE `$tableName` (
          `id` int(11) unsigned NOT NULL auto_increment,
          `lft` int(11) default NULL,
          `rgt` int(11) default NULL,
          `level` smallint(3) default NULL,
          `parent_id` int(11) default NULL,
          `type` smallint(1) default NULL,
          `url` varchar(255) default NULL,
          `name` varchar(255) default NULL,
          `title` varchar(255) default NULL,
          `content` text,
          `layout` varchar(255) default NULL,
          `section` varchar(255) default NULL,
          `subsection` varchar(255) default NULL,
          `overview_page` tinyint(1) default NULL,
          `keywords` varchar(255) default NULL,
          `description` varchar(255) default NULL,
          `access_level` tinyint(1) default NULL,
          PRIMARY KEY  (`id`),
          KEY `lft` (`lft`),
          KEY `rgt` (`rgt`),
          KEY `level` (`level`),
          KEY `name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
        
        $tableCreated = $createTable->execute();
        
        $initialData = new CDbCommand($db,"
            insert  into `$tableName` 
            (`id`,`lft`,`rgt`,`level`,`parent_id`,`type`,`url`,`name`,`title`,`content`,`layout`,`section`,`subsection`,`overview_page`,`keywords`,`description`,`access_level`) 
            values (1,0,1,0,0,0,'/','Site index','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL)
        ");
        $tableFilled = $initialData->execute();
        if ($tableCreated==0 && $tableFilled){
            $this->render('index',array('result'=>"Database installed successfully!!! Table name: $tableName"));
        }
    }
    
    function checkModuleInstalled()
    {
        $tableName = $this->getTableName();
        // check if table exists
        $tableExists = new CDbCommand(Yii::app()->getDb(),"
            show tables like '$tableName'
        ");
        try{
            $exists = $tableExists->queryColumn();
        } catch (Exception $e) {
            $exists = false;
        }
        return $exists ? true : false;
    }
    
    function getTableName(){
        $tableName = CMS::TABLE_NAME;
        $tableName = substr($tableName,2,strlen($tableName)-4);
        $prefix = Yii::app()->getDb()->tablePrefix;
        $tableName = $prefix.$tableName;
        return $tableName;
    }
}