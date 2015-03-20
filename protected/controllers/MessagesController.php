<?php

class MessagesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/main-template';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
                        /*
			array('deny',  // deny all users
				'users'=>array('*'),
			),
                         * 
                         */
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionDialog($user)
	{
            $model=new Messages;
            
            $dataProvider=new CActiveDataProvider('Messages',array(
                'criteria'=>array(
                    'condition'=>' (sender_id="'.$user.'" and receiver_id="'.Yii::app()->user->id.'" ) '
                    . 'or (sender_id="'.Yii::app()->user->id.'" and receiver_id="'.$user.'" )'
                    )
            ));
            
            $userData=User::model()->findByPk($user);

            $this->render('dialog',array(
                'dataProvider'=>$dataProvider,
                'userData'=>$userData,
                'model'=>$model,
            ));
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id)
	{
		$model=new Messages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                //var_dump(Yii::app()->request->getPost('Messages'));

		if(Yii::app()->request->getPost('Messages'))
		{
			$model->attributes=Yii::app()->request->getPost('Messages');
                        $model->receiver_id=$id;
                        $model->sender_id=Yii::app()->user->id;
                        $model->send_date=date('Y-m-d H:i:s'); //тупо но не нашел быстрого решения
                        
			if($model->validate()){
                            $model->save();
                            $this->redirect(array('messages/dialog','user'=>$id));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'receiver'=>$id,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Messages']))
		{
			$model->attributes=$_POST['Messages'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Вывод пользователей с которыми ведется переписка
         * для текущего пользователя
	 */
	public function actionIndex()
	{

            // --- Переделать в более подходящий вид
            $command=Yii::app()->db->
            createCommand('SELECT max(messages.send_date) as last_date, '
            . 'count(distinct messages.id) as count_mes, users.username, '
            . 'if(receiver_id="'.Yii::app()->user->id.'",sender_id,receiver_id) as interlocutor '
            . 'FROM messages left join users on users.id=sender_id or '
            . 'users.id=receiver_id and users.id!="'.Yii::app()->user->id.'" '
            . 'where sender_id="'.Yii::app()->user->id.'" or '
            . 'receiver_id="'.Yii::app()->user->id.'" group by interlocutor');

            $mesData=$command->queryAll();

            $dataProvider=new CArrayDataProvider($mesData, array(
                'id'=>'interlocutor',
                'sort'=>array(
                    'attributes'=>array(
                         'interlocutor'
                    ),
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Messages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Messages']))
			$model->attributes=$_GET['Messages'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Messages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Messages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Messages $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='messages-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
