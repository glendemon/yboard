<?php

class CompanyController extends Controller
{
	public $defaultAction = 'index';

	public $layout='//main-template';


	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function actionView()
	{

		$model = $this->loadUser();
	    $this->render('profile',array(
	    	'model'=>$model,
			'profile'=>$model->profile,
	    ));
	}
	
	public function actionIndex()
	{
		
		$dataProvider=new CActiveDataProvider('Profile', array(
			'criteria'=>array(
				'limit'=>10,
			))
		);
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			)
		);
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = $this->loadUser();
		$profile=$model->profile;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
                Yii::app()->user->updateSession();
				Yii::app()->user->setFlash('profileMessage',UserModule::t("Changes is saved."));
				$this->redirect(array('/user/profile'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	



}