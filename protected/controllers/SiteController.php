<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	
	public $layout='/main-template';

	public function actions()
	{
		return array(
            'create' => 'application.controllers.site.CreateAction' ,
            //'importUsers' => 'application.controllers.site.ImportUsersAction' ,
            //'importBulletins' => 'application.controllers.site.ImportBulletinsAction' ,
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function actionGetfields($cat_id){
		$model= Category::model()->findByPk($cat_id);
		
		$fields=json_decode($model->fields);

		if(sizeof($fields)>0)
		foreach($fields as $f_iden=>$fv){ ?>
			<div class="controls">
				<label for='Fields[<?=$f_iden?>]'><?=$fv->name?></label><input type="text" id="Fields[<?=$f_iden?>]" name="Fields[<?=$f_iden?>]" >
			</div>	
		<? }
	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform actions
				'actions'=>array('index','error','contact','bulletin','category','captcha','page','advertisement','getfields','search'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user
				'actions'=>array('importUsers','importBulletins'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $roots=Category::model()->roots()->findAll();
		$criteria = new CDbCriteria();
		$criteria->limit=10;
		$criteria->order='id desc';
        $IndexAdv = Adverts::model()->findAll($criteria);
		$this->render('index',array(
			'roots'=>$roots,
			'IndexAdv'=>$IndexAdv,
		));
	}

    /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
     * @param int $id User's id
	 */
	public function actionContact($id = null)
	{
        $user = $id ? $this->loadUser($id) : null;
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";
                $mail = $user ? $user->email : Yii::app()->params['adminEmail'];

				mail($mail,$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model, 'user'=>$user));
	}


    public function actionView($id)
    {
        $model = $this->loadAdvert($id);
        $model->views++;
        $model->disableBehavior('CTimestampBehavior');
        $model->save();
		$this->render('bulletin', array(
			'model'=>$model,
		));
    }



    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadAdvert($id)
	{
		$model=loadAdvert::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadCategory($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadUser($id)
	{
		$model=Yii::app()->getModule('user')->user($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	

}