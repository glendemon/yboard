<?php

class CategoryController extends BackendController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/admin-template';
    public $title = 'Категории';

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
        $model = new Category;
        $model->detachBehavior("NestedSetBehavior");
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        // Создаем корневую директорию 
        $last_root = Yii::app()->db->createCommand("select root from category order by root desc limit 1")->queryScalar();


        if (isset($_POST['Category'])) {

            $model->attributes = $_POST['Category'];
            $model->lft = 1;
            $model->rgt = 2;
            $model->level = 1;
            $model->root = $last_root + 1;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        $model->detachBehavior("NestedSetBehavior");

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Category'])) {
            $model->attributes = $_POST['Category'];

            $model->fieldsSave();

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $model->fields = json_decode($model->fields);

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Импортируеть категории из файла. Вложеность категории определяется табами
     * Категории импортируются из файла cats_list.txt
     * Скрытая функция без входных параметров
     * Необходимо отключение транзакционных функции и пустой список категории
     */
    public function actionImport() {

        $cats_file_path = "cats_list.txt";
        
        die("Отключен");
        
        if( !is_file($cats_file_path) ) {
            echo "file it's empty";
            return false;
        }

        $levels_tab = array();
        $last_parent_id = 1;
        $last_root = 1;
        $last_level = 1;

        

        error_reporting(E_ALL ^ E_NOTICE);
        ini_set("display_errors", 1);

        $cat_list = file($cats_file_path);

        echo sizeof($cat_list);

        foreach ($cat_list as $cat) {

            if (trim($cat) !== "") {
                preg_match("#(\t*)(?=[^\s])#i", $cat, $m);



                $cat_name = trim($cat);
                $cat_level = strlen($m[0]) + 1;



                if ($cat_level > 1) {

                    if ($cat_level > $last_level) {
                        $levels_tab[] = array($last_parent_id, $last_parent_root);
                        $last_parent_id = $last_id;
                        $last_parent_root = $last_root;
                        $last_level = $cat_level;
                    }

                    if ($cat_level < $last_level) {
                        if (sizeof($levels_tab) > 0) {
                            list($last_parent_id, $last_parent_root) = array_pop($levels_tab);
                        } else {
                            $last_parent_id = 1;
                            $last_parent_root = 1;
                        }
                        $last_level = $cat_level;
                    }

                    /*
                      $_POST['moved_node'] = $model->id ;
                      $_POST['new_parent'] = $last_parent_id;
                      $_POST['new_parent_root'] = $last_parent_root;
                      $_POST['previous_node'] = 'false';
                      $_POST['copy'] = 'false';

                      var_dump($_POST);
                     * 
                     */

                    //$this->actionMoveCopy();

                    echo " парент $last_parent_id ";

                    $model = new Category;
                    $model->name = $cat_name;

                    $model_parent = CActiveRecord::model("Category")->findByPk($last_parent_id);


                    $model->appendTo($model_parent);
                } else {

                    echo " создание корневой ";

                    $model = new Category;
                    $model->detachBehavior("NestedSetBehavior");
                    // Uncomment the following line if AJAX validation is needed
                    // $this->performAjaxValidation($model);
                    // Создаем корневую директорию 
                    $last_root = Yii::app()->db->createCommand("select root from category order by root desc limit 1")->queryScalar();

                    $model->name = $cat_name;
                    $model->lft = 1;
                    $model->rgt = 2;
                    $model->level = 1;
                    $model->root = $last_root + 1;
                    $model->save();

                    $last_parent_id = $model->id;

                    $levels_tab = array();
                    $last_level = 1;
                }



                echo $model->id . "  ";
                echo $cat_name . "  ";
                echo $cat_level . "<br/>";

                $last_id = $model->id;
                $last_root = $model->root;
            }
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $cat_model = $this->loadModel($id);
        //$cat_model->detachBehavior("NestedSetBehavior");
        $cat_model->deleteNode();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Category');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Category('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Category']))
            $model->attributes = $_GET['Category'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function behaviors() {
        return array(
            'jsTreeBehavior' => array('class' => 'application.behaviors.JsTreeBehavior',
                'modelClassName' => 'Category',
                'form_alias_path' => '_form',
                'view_alias_path' => 'view',
                'label_property' => 'name',
                'rel_property' => 'name'
            )
        );
    }

}
