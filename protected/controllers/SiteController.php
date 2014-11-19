<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
<<<<<<< HEAD
	
	public $layout='/main-template';
	
=======
>>>>>>> origin/master
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
<<<<<<< HEAD
	
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
=======
>>>>>>> origin/master

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform actions
<<<<<<< HEAD
				'actions'=>array('index','error','contact','bulletin','category','captcha','page','advertisement','getfields','search'),
=======
				'actions'=>array('index','error','contact','bulletin','category','captcha','page','advertisement'),
>>>>>>> origin/master
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
		$this->render('index',array(
			'roots'=>$roots,
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

    /**
     * Show bulletin.
     * @param int $id Bulletin's id
     */
    public function actionBulletin($id)
    {
        $model = $this->loadBulletin($id);
        $model->views++;
        $model->disableBehavior('CTimestampBehavior');
        $model->save();
		$this->render('bulletin', array(
			'model'=>$model,
		));
    }

    /**
     * Show category.
     * @param int $id Category's id
     */
<<<<<<< HEAD
    public function actionCategory($cat_id)
=======
    public function actionCategory($id)
>>>>>>> origin/master
    {
        $dataProvider=new CActiveDataProvider('Bulletin', array(
            'criteria'=>array(
                'select'=>'*, IFNULL(updated_at, created_at) as sort',
                'condition'=>'category_id = :id',
                'order' => 'sort DESC',
<<<<<<< HEAD
                'params'=>array(':id'=>(int)$cat_id),
            ),
        ));
		$this->render('category', array(
			'model'=>$this->loadCategory($cat_id),
=======
                'params'=>array(':id'=>(int)$id),
            ),
        ));
		$this->render('category', array(
			'model'=>$this->loadCategory($id),
>>>>>>> origin/master
            'dataProvider'=>$dataProvider,
		));

    }

    /**
     * Show Advertisement.
     * @param int $id Advertisement's id
     */
    public function actionAdvertisement($id)
    {
        $model = $this->loadAdvertisement($id);
		$this->render('advertisement', array(
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
	public function loadBulletin($id)
	{
		$model=Bulletin::model()->findByPk($id);
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
	public function loadAdvertisement($id)
	{
		$model=Advertisement::model()->findByPk($id);
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
<<<<<<< HEAD
	
	public function actionSearch($searchStr=""){
		$model=new Bulletin('search');
				
		$model->unsetAttributes();  // clear any default values
		$model->name=$searchStr;
		$model->text=$searchStr;
		

		
		$this->render('search',array(
			'model'=>$model,
		));

	}
=======
>>>>>>> origin/master
}