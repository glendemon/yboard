<?php

class CmsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//admin/admin-template';
    public $defaultAction = 'admin';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('admin', 'delete', 'sort', 'translit', 'getParentUrl'),
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Cms;

        if ($_GET['parent_id'])
            $model->parent_id = $_GET['parent_id'];

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Cms'])) {
            $model->attributes = $_POST['Cms'];

            $model->type = $_GET['type'];

            $parentNode = Cms::model()->findByPk($model->parent_id);

            if ($model->validate() && $parentNode->appendChild($model)) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'update';

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Cms'])) {
            $model->attributes = $_POST['Cms'];
            if ($model->id == 1) {
                $model->url = '/';
            }
            if ($model->save()) {
                if ($newParent = Cms::model()->findByPk($model->parent_id)) {
                    $newParent->appendChild($model);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        
        var_dump($this->layout);

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id);

            $model->deleteNode($model->type == Cms::PAGESET);

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        return $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($parent_id = 1) {
        $model = new Cms('search');
        $model->unsetAttributes();  // clear any default values
        $model->parent_id = $parent_id;

        if (isset($_GET['Cms']))
            $model->attributes = $_GET['Cms'];

        $page = Cms::model()->find('id=:id', array(':id' => $parent_id));

        $this->render('admin', array(
            'model' => $model,
            'page' => $page,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Cms::model()->findByPk((int) $id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cms-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSort($parent_id) {
        $item = Cms::model()->findByPk($_POST['item']);

        if ($item && $_POST['prev']) {
            $prev = Cms::model()->findByPk($_POST['prev']);
            $item->moveAfter($prev);
        } elseif ($item && $_POST['next']) {
            $next = Cms::model()->findByPk($_POST['next']);
            $item->moveBefore($next);
        }
        echo 'OK';
    }

    public function getFormPartial($model = null) {
        if (!$model)
            $type = $_GET['type'];
        else if ($model->id == 1)
            return 'root';
        else
            $type = $model->type;

        switch ($type) {
            case Cms::PAGE:
                return 'page';
            case Cms::PAGESET:
                return 'pageset';
            case Cms::LINK:
                return 'link';
        }
    }

    public function getTranslitUrl() {
        return $this->createUrl('translit');
    }

    public function getGetParentUrl() {
        return $this->createUrl('getParentUrl');
    }

    public function actionGetParentUrl() {
        $parentId = $_POST['parent_id'];
        $parent = Cms::model()->findByPk($parentId);
        if ($parent && $parent->url)
            echo $parent->url . '/';
    }

    public function actionTranslit() {
        Yii::import('application.extensions.UrlTransliterate.UrlTransliterate');
        echo UrlTransliterate::cleanString($_POST['name']);
    }

    function publishJS() {
        $jsFile = substr(dirname(__FILE__), 0, strrpos(dirname(__FILE__), DIRECTORY_SEPARATOR)) . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'jquery.yii.cms.js';
        $jsFile = Yii::app()->getAssetManager()->publish($jsFile);

        Yii::app()->getClientScript()->registerScriptFile($jsFile, CClientScript::POS_HEAD);
    }

    function initTranslit() {
        Yii::app()->getClientScript()->registerScript('#yiiCms', "
            jQuery.fn.setUrl({
                parentUrl: '{$this->getParentUrl}',
                translitUrl: '{$this->translitUrl}'
            });
        ");
    }

    function initSort() {
        Yii::app()->clientScript->registerCoreScript('jquery.ui');

        $sortUrl = $this->createUrl('sort', array('parent_id' => $_GET['parent_id']));

        Yii::app()->getClientScript()->registerScript(__CLASS__ . '#items', "
            jQuery.fn.initSort({sortUrl:'{$sortUrl}'});
        ");
    }

    function FckEditorAvailable() {
        $editorPath = Yii::getPathOfAlias('application.extensions.ckeditor.CKEditor');
        if (file_exists($editorPath . '.php'))
            return true;
        return false;
    }

}
