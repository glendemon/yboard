<?php

class CatImpController extends BackendController
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    public $layout = '/admin-template';
    public $title='Категории';



    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $levels_tab = array();
        $last_parent_id = 1;
        $last_root = 1;
        $last_level = 1;
        
        //die("Отключен временно");
        
        error_reporting(E_ALL^E_NOTICE);
        ini_set("display_errors",1);

        $cat_list = file("cats_list.txt"); 
        
        echo sizeof($cat_list);

        foreach( $cat_list as $cat ) {

            if(trim($cat)!=="") {
                preg_match("#(\t*)(?=[^\s])#i", $cat, $m);
             


                $cat_name = trim($cat);
                $cat_level = strlen($m[0]) + 1;
                
                                

                if( $cat_level>1 ) {

                    if( $cat_level > $last_level ) {
                        $levels_tab[] = array($last_parent_id , $last_parent_root);
                        $last_parent_id = $last_id;
                        $last_parent_root = $last_root;
                        $last_level = $cat_level;
                    }

                    if( $cat_level < $last_level ) {
                        if( sizeof($levels_tab)>0 ) {
                            list($last_parent_id, $last_parent_root) = array_pop ($levels_tab);
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

                } else{ 
						
						echo " создание корневой ";
						
                        $model = new Category;
                        $model->detachBehavior("NestedSetBehavior");
                        // Uncomment the following line if AJAX validation is needed
                        // $this->performAjaxValidation($model);

                        // Создаем корневую директорию 
                        $last_root= Yii::app()->db->createCommand("select root from category order by root desc limit 1")->queryScalar();

                        $model->name = $cat_name;
                        $model->lft = 1;
                        $model->rgt = 2;
                        $model->level = 1;
                        $model->root = $last_root+1;
                        $model->save();
						
						$last_parent_id = $model->id;
						
						$levels_tab = array();
						$last_level = 1;
                    
                }
				
				
				
				echo $model->id."  ";
				echo $cat_name."  ";
                echo $cat_level."<br/>";
                
                $last_id = $model->id ;
                $last_root = $model->root; 

            }
        }
    }



    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Category the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Category $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'category-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function behaviors()
    {
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
