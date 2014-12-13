<?php

class SettingsController extends BackendController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    public $layout = '/admin-template';
	public $title='Настройки';



    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new ConfigForm(Yii::getPathOfAlias('application.config.settings').'.php');
		$InitConf=$model->getConfig();
				
		if(isset($_POST['config']))
		{
		
			foreach($_POST['config'] as $n=>$v) {
				foreach($v as $n1=>$v1){
					if(trim($v1)===""){
						unset($_POST['config'][$n][$n1]);
					}
				}
				
				if(sizeof($InitConf[$n])>=sizeof($_POST['config'][$n]))
				$InitConf[$n]=$_POST['config'][$n];
			}
	
			if($model->validate())
			{
				
				$conf_str=var_export($InitConf,true);
				$atr=$model->getAtribute();
				foreach($atr as $n=>$v) {
					$conf_str=preg_replace("#([^\n\r]*".$n."[^\n\r]*)[\n\r]#is","\\1//".$v."\n",$conf_str);
				}
							
				file_put_contents(Yii::getPathOfAlias('application.config.siteConfig').'.php',"<? \n return ".$conf_str." \n ?>");
				
				$this->refresh();
			}
		}
		$this->render('/config',array('model'=>$model));
    }

  

}
