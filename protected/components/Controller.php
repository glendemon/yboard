<?php
/**
 * BaseController.php
 *
 * Date: 11/15/12
 * Time: 22:46 PM
 *
 * This controllers makes possible for controllers that extend from it to inherit
 * actions from behaviors
 *
 * Idea by Yii user Mimin and  Kevin Higgins
 * @link http://www.yiiframework.com/forum/index.php/user/9488-mimin/
 * @link http://www.yiiframework.com/forum/index.php/user/24587-kevin-higgins/
 * Relevant discussion in Yii Forum
 * @link http://www.yiiframework.com/forum/index.php/topic/10652-actions-by-behavioring/
 *
 */

 
// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');


function t($str,$dict='lang'){
    return Yii::t($dict,$str);
}

class Controller extends CController

{
	
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */

	public $breadcrumbs=array();
        private $_behaviorIDs = array();
	public $layout='//main-template';


	public $menu=array();

	public $settings=array();
	public $banners=array();
	public $categories=array();
	public $title="";
	
	public function  init()
    {
        parent::init();
    }

	public function __construct($id, $module = null)
	{
            
                // var_dump($this->route);
			
		parent::__construct($id, $module);
		
		
                //var_dump();
                
		if(Yii::app()->params['installed']==="yes"){
			$this->settings = include_once Yii::getPathOfAlias('application.config.settings').'.php';
			$this->banners = include_once Yii::getPathOfAlias('application.config.banners').'.php';
			$this->categories = $command = Yii::app()->db->createCommand('SELECT * FROM category')->queryAll();
		} elseif(Yii::app()->getRequest()->getPathInfo()!=="site/install") {
			$this->redirect(Yii::app()->baseUrl.'/site/install');
		}
	}
	
	public function getBanner($var){
		$debug="";

		if(YII_DEBUG) {
			$debug= "<div style='background:#990000; min-height:20px;' align='center'>".$var."</div>";
			if(!isset($this->banners[$var]))
				$debug.= "No Ads";
		}

		if(isset($this->banners[$var]) and sizeof($this->banners[$var])>0)
			if(is_array($this->banners[$var])){
			return "<div class='pblock ".$var."' align='center'>".$debug.$this->banners[$var][array_rand($this->banners[$var],1)]."</div>";
			}else
			return "<div class='pblock ".$var."' align='center'>".$debug.$this->banners[$var]."</div>";
		else
			return $debug;
	
	}

    public function createAction($actionID)
    {
        $action = parent::createAction($actionID);
        if ($action !== null)
            return $action;
        foreach ($this->_behaviorIDs as $behaviorID) {
            $object = $this->asa($behaviorID);
            if ($object->getEnabled() && method_exists($object, 'action' . $actionID))
                return new CInlineAction($object, $actionID);
        }
    }

    public function attachBehavior($name, $behavior)
    {
        $this->_behaviorIDs[] = $name;
        parent::attachBehavior($name, $behavior);
    }


}