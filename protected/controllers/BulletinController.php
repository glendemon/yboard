<?php

class BulletinController extends Controller
{

	
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform actions
				'actions'=>array('index','error','view','contact','bulletin','category','captcha','page','advertisement','getfields','search'),
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
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function actionGetfields($cat_id){
		
		$model_count=  Category::model()->count(array(
			'select'=>'count(*) as cnt',
			'condition'=>'root='.$cat_id,
			));
		
		// Получение категории
		$model= Category::model()->findByPk($cat_id);

		// Проверка есть ли дочерние 
		if($model->lft+1 == $model->rgt) {
			
			echo "<div id='fields_list'>";
			$fields=json_decode($model->fields);

			if(sizeof($fields)>0)
			foreach($fields as $f_iden=>$fv){ ?>
				<div class="controls">
					<label for='Fields[<?=$f_iden?>]'><?=$fv->name?></label><input type="text" id="Fields[<?=$f_iden?>]" name="Fields[<?=$f_iden?>]" >
				</div>	
			<? }
			
			echo "</div>";
			
		} else {
			// Вывод дочерних категории
			$subcat= Yii::app()->db->createCommand('select id,name  from category  where root='.$model->root.' and lft>'.$model->lft.' and rgt<'.$model->rgt.' ')->query();
			
			
			
			$drop_cats=array();
			
			foreach($subcat as $cat){
				
				$drop_cats[$cat['id']]=$cat['name'];
				
			};
			
			echo CHtml::dropDownList('subcat_'.$cat_id,0,$drop_cats,array('empty' => Yii::t('bulletin', 'Choose category'),'onchange'=>'loadFields(this)'));
			
			return; 
		}
	
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
	public function actionCreate(){
		
		$model=new Bulletin;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bulletin']))
		{
			$model->attributes = $_POST['Bulletin'];
            $model->user_id = Yii::app()->user->id;
			$model->fields=serialize($_POST['Fields']);


			if($model->save())
            {
                $video = CUploadedFile::getInstances($model, 'youtube_id');
                YoutubeHelper::processBulletin($model, $video);

                $images = CUploadedFile::getInstancesByName('images');
                // proceed if the images have been set
                ImagesHelper::processImages($model, $images);
				$this->controller->redirect(array('site/bulletin','id'=>$model->id));
            }
		}

        $this->render('create', array(
            'model' => $model,
        ));
	}

	/**
     * Show bulletin.
     * @param int $id Bulletin's id
     */
    public function actionView($id)
    {
        $model = $this->loadBulletin($id);
        $model->views++;
        $model->disableBehavior('CTimestampBehavior');
        $model->save();
		$model->fields=unserialize($model->fields);
		$this->render('view', array(
			'model'=>$model,
		));
    }

    /**
     * Show category.
     * @param int $id Category's id
     */
    public function actionCategory($cat_id)
    {
        $dataProvider=new CActiveDataProvider('Bulletin', array(
            'criteria'=>array(
                'select'=>'*, IFNULL(updated_at, created_at) as sort',
                'condition'=>'category_id = :id',
                'order' => 'sort DESC',
                'params'=>array(':id'=>(int)$cat_id),
            ),
        ));
		$this->render('category', array(
			'model'=>$this->loadCategory($cat_id),

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
	
	public function actionSearch($searchStr=""){
		$model=new Bulletin('search');
				
		$model->unsetAttributes();  // clear any default values
		$model->name=$searchStr;
		$model->text=$searchStr;
		

		
		$this->render('search',array(
			'model'=>$model,
		));

	}

}