<?php

class DefaultController extends BackendController
{
    /**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionConfig()
	{
		$model=new ConfigForm;
        foreach ($model->attributes as $attr => $val) {
            $model->$attr = Yii::app()->config->get($attr);
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ConfigForm']))
		{
			$model->attributes = $_POST['ConfigForm'];
            foreach ($model->attributes as $attr => $val)
            {
				Yii::app()->config->set($attr, $val);
            }
            Yii::app()->user->setFlash('success', AdminModule::t('Config updated.'));
            $this->redirect(array('config'));
		}

        $this->render('config', array(
            'model' => $model,
        ));

	}

}