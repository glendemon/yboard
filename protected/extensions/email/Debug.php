<?php
class Debug extends CWidget {
	public function run() {
		if(Yii::app()->user->hasFlash('email')) {
			//register css file
			$url = CHtml::asset(Yii::getPathOfAlias('application.extensions.email.css.debug').'.css');
			Yii::app()->getClientScript()->registerCssFile($url);
			
			//dump debug info
			echo Yii::app()->user->getFlash('email');
			//Yii::app()->user->setFlash('email', null);
		}
	}
}