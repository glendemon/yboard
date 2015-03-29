<?php

class Cms extends CActiveRecord
{
    const PAGESET = 0;
    const PAGE = 1;
    const LINK = 2;
    
    const ALL_USERS = 0;
    const AUTH_ONLY = 1;
    const TABLE_NAME = "{{article}}";
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return Cms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return self::TABLE_NAME;
	}
    
    public function behaviors()
    {
        return array(
            'TreeBehavior' => array(
                'class' => 'application.extensions.nestedset.TreeBehavior',
                '_idCol' => 'id',
                '_lftCol' => 'lft',
                '_rgtCol' => 'rgt',
                '_lvlCol' => 'level',
            ),
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lft, rgt, level, parent_id, type, overview_page, access_level', 'numerical', 'integerOnly'=>true),
			array('url, name, title, layout, section, subsection', 'length', 'max'=>255),
            array('content, layout, section, subsection, overview_page, keywords, description, access_level', 'safe'),
            array('name,url,parent_id,url', 'required'),
            array('url', 'checkUrl'),
            array('access_level', 'default', 'value'=>0),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lft, rgt, level, parent_id, type, url, name, title, content, keywords, description, access_level', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'id' => t('ID'),
                    'lft' => t('Lft'),
                    'rgt' => t('Rgt'),
                    'level' => t('Level'),
                    'parent_id' => t('Parent'),
                    'type' => t('Type'),
                    'url' => t('Url'),
                    'name' => t('Page name'),
                    'title' => t('Title'),
                    'content' => t('Content'),
                    'layout' => t('Layout'),
                    'section' => t('Section'),
                    'subsection' => t('Subsection'),
                    'keywords' => t('Keywords'),
                    'description' => t('Description'),
                    'access_level' => t('Page access'),
		);
	}
    
    public function defaultScope()
    {
        return array(
            'order'=>'id=1 DESC, lft ASC'
        );
    }
    
    public function scopes()
    {
        return array(
            'asc'=>array(
                'order'=>'lft ASC',
            ),
        );
    }
    
    public function beforeSave()
    {
        if ($this->type!=self::LINK)
        {
            $this->normalizeUrl();   
        }
        return true;
    }
    
    function normalizeUrl()
    {
        $pieces = preg_split('/\\//',$this->url,null,PREG_SPLIT_NO_EMPTY);
        $this->url = implode('/',$pieces);
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($parent_id=1)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
        
		$criteria=new CDbCriteria;
        
        if ( !@$_GET['Cms'] || (empty($_GET['Cms']['name']) && empty($_GET['Cms']['url'])))
        {
            $criteria->condition = 'parent_id='. $parent_id;
        }

	    $criteria->compare('type',$this->type);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('name',$this->name,true);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>10000,
            ),
		));
	}
    
    public function getPageType($type=null)
    {    
        $types =  $this->getTypes();
        return $types[isset($type) ? $type : $this->type];
    }
    
    public function getTypes()
    {
        return array(
            self::PAGE => 'Page',
            self::PAGESET => 'Set of pages',
            self::LINK => 'Link',
        );
    }
    
    public function getAccessLevels()
    {
        return array(
            self::ALL_USERS => 'All users',
            self::AUTH_ONLY => 'Authorised only',
        );
    }
    
    public function getAccessLevel()
    {
        $levels = $this->getAccessLevels();
        return $levels[(int)$this->access_level];
    }
    
    public function getParents()
    {
        $cond = $_GET['id'] ? 'id!='.$_GET['id'] : null;
        $models = Cms::model()->findAllByAttributes(array('type'=>self::PAGESET),$cond);
        $list = array();
        foreach ($models as $model)
        {
            $list[$model->id] = str_repeat("....",$model->level).' '.$model->name;
        }
        return $list;
    }
    
    /*** BREADCRUMBS PART ***/
    
    public function getBreadcrumbs($linkAll=false)
    {
        $pageId = $this->id;
        $bc = array('Site root'=>array('cms/admin'));
        $parents = Cms::model()->asc()->findAll("rgt>={$this->rgt} AND lft<={$this->lft} AND parent_id!=0");
        if ($parents)
        {
            $bc = array();
            $cnt = count($parents);
            foreach ($parents as $k=>$p)
            {
                if (!$linkAll && $k+1==$cnt)
                    $bc[] = $p->name;
                else
                    $bc[$p->name] = array($p->url);
            }
        }
        return $bc;
    }
    
    public function getAdminBreadcrumbs($linkAll=false)
    {
        $pageId = $this->id;
        if (!$pageId) return array();
        $parents = Cms::model()->asc()->findAll("rgt>={$this->rgt} AND lft<={$this->lft} /*AND parent_id!=0*/");
        if ($parents)
        {
            $bc = array();
            $cnt = count($parents); 
            foreach ($parents as $k=>$p)
            {
                if (!$linkAll && $k+1==$cnt)
                    $bc[] = $p->name;
                else
                    $bc[$p->name] = array('cms/admin','parent_id'=>$p->id);
            }
            return $bc;
        }
        return array();
    }
    
    /*** TEMPLATES PART ***/
    
    public function getLayouts()
    {
        $path = Yii::app()->viewPath.DIRECTORY_SEPARATOR.'layouts';
        $ignoredLayouts = Yii::app()->getModule('cms')->ignoredLayoutsMask;
        return $this->getTemplates($path,null,null,$ignoredLayouts);
    }
    
    public function getSections()
    {                 
        $rootPath = '/cms/sections/';
        $path = Yii::app()->viewPath.DIRECTORY_SEPARATOR.'cms'.DIRECTORY_SEPARATOR.'sections';
        $tpls= $this->getTemplates($path,$rootPath);
        return $tpls;
    }
    
    public function getSubsections()
    {
        $rootPath = '/cms/subsections/';
        $path = Yii::app()->viewPath.DIRECTORY_SEPARATOR.'cms'.DIRECTORY_SEPARATOR.'subsections';
        return $this->getTemplates($path,$rootPath);        
    }
    
    public function getTemplates($dir,$rootPath='', $level=0,$ignoredLayoutsMask=false)
    {
        GLOBAL $App;
        STATIC $list = array();    
        $path = $dir;

        $pathPrefix = '';
        if ($level>0)
        {
            $pathPieces = explode(DIRECTORY_SEPARATOR,$dir);
            $piecesCount = count($pathPieces);
            $pathPieces = array_slice($pathPieces,$piecesCount-$level,$level);
            $pathPrefix = implode('/',$pathPieces).'/';
        }
        $offset = str_repeat('....',$level);
        if (false!== ($handle = opendir($path)))
        {
            while (false !== ($file = readdir($handle)))
            {
                if ($file{0} == '.') continue;
                list($name) = explode('.', $file);
                if (is_file($path.DIRECTORY_SEPARATOR.$file))
                {            
                    $filePath = $rootPath.$pathPrefix.$name;
                    if ($ignoredLayoutsMask && preg_match($ignoredLayoutsMask,$file)) continue;
                    $list[$filePath] = $offset. $name;
                }
                if (is_dir($path.DIRECTORY_SEPARATOR.$file))
                {
                    $innerDir = $path.DIRECTORY_SEPARATOR.$file;

                    //$list[$pathPrefix.$name] = $this->searchTemplates($innerDir, $level+1);
                    $list[$offset . $name] = array();
                    $this->getTemplates($innerDir, $rootPath, $level+1);
                }
            }
            closedir($handle);
        }
        if ($level==0){
            $lst = $list;
            $list = array();
        }
        return $lst;
    }
    
    /*** validator for URL (on update) ***/
    function isTaken()
    {
        $this->normalizeUrl();
        $params = array(
            ':url'=>$this->url,
            ':type_link'=>self::LINK,
        );
        if (!$this->getIsNewRecord())
        {
          $params[':id'] = $this->id;  
          $idCond .= ' AND id!=:id';
        }
        $count = Cms::model()->count('url=:url AND type!=:type_link'.$idCond,$params);
        return $count;
    }
    
    function checkUrl($attr,$params)
    {
        if ($this->type==self::LINK) return true;
        $isTaken = $this->isTaken();
        if ($this->scenario=='update' && $isTaken>0)
        {
            $this->addError('url','Url is taken. Choose another one!');
        }
    }
    
    function getImage()
    {
        $images = array(
            self::PAGESET=>'pageset.gif',
            self::PAGE=>'page.gif',
            self::LINK=>'link.gif',
        );
        return CHtml::image(Yii::app()->request->getBaseUrl().'/images/cms/'.$images[$this->type],null,array('class'=>'drag'));
    }
    
    public static function getLevelMenu($attributes=array('parent_id'=>0))
    {
        if ($items = self::model()->findAllByAttributes($attributes))
        { 
            $menu = array();
            foreach ($items as $item)
            {
                $menu[] = array('label'=>$item->name,'url'=>array($item->url));
            }
            return $menu;
        }
        return array();
    }
}