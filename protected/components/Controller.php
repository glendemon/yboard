<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $settings=array();
	public $banners=array();
	public $title="";

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->settings = include_once Yii::getPathOfAlias('application.config.settings').'.php';
		$this->banners = include_once Yii::getPathOfAlias('application.config.banners').'.php';
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
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
}