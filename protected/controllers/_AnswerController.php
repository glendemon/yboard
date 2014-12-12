<?php

class AnswerController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate()
	{
		$model=new Answer;

        if(isset($_POST['Answer']))
		{
            if (!$this->canUserReply())
                unset($_POST['Answer']['parent_id']);
			$model->attributes = $_POST['Answer'];
            $model->user_id = Yii::app()->user->id;

			if($model->save())
            {
                Yii::app()->user->setFlash('success', Yii::t('main', 'You successfully add question.'));
				$this->redirect(array('index'));
            }
		}

		$this->render('index');
	}

	public function actionIndex()
	{
        $dataProvider=new CActiveDataProvider('Answer', array(
            'criteria'=>array(
                'condition'=>'parent_id is null',
            ),
        ));
        $model=new Answer;
		$this->render('index', array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
		));
	}

    /**
     * Can current user reply?
     * @return bool
     */
    public function canUserReply()
    {
        if (Yii::app()->user->isAdmin())
            return true;
        $user_id = Yii::app()->user->id;
        $ids = Yii::app()->config->get('answer');
        $ids = $ids ? $ids : array();
        return in_array($user_id, $ids);
    }

}