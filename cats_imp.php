<?php
header("Content-Type: text/html; charset=UTF-8");

//Настройка вывода сообщений
error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors",1);




if( isset($_COOKIE['YII_DEBUG']) ) {
		
    // Подключение параметров для режима отладки 
	$yii=dirname(__FILE__).'/../framework/yii.php';
	$CONFIG=dirname(__FILE__).'/protected/config/main_dev.php';
	
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
                
} else {
	
	
	
    // Подключение стандартных параметров
	$yii=dirname(__FILE__).'/framework/yii.php';
	$CONFIG=dirname(__FILE__).'/protected/config/main.php';
	// Отключение вывода сообщений
	error_reporting(E_WARNING);
	ini_set("display_errors",0);
}

require_once($yii);
Yii::createWebApplication($CONFIG)->run();


error_reporting(E_ALL^E_NOTICE);
ini_set("display_errors",1);


$levels_tab = array();
$last_parent_id = 1;
$last_root = 1;
$last_level = 1;


$cat_list = file("cat_list.txt"); 

foreach( $cat_list as $cat ) {
    
    if(trim($cat)!=="") {
        preg_macth("#(\t*)(?=[^\s])#i", $cat, $m);
        
        var_dump( $m );
        
        echo "ffffffffffffff";
        
        die;

$cat_name = trim($cat);
$cat_level = strlen($m[0]);


$model = new Category;
$model->detachBehavior("NestedSetBehavior");
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

// Создаем корневую директорию 
$last_root= Yii::app()->db->createCommand("select root from category order by root desc limit 1")->queryScalar();

$model->name = $cat_name;
$model->lft = 1;
$model->rgt = 2;
$model->level = $cat_level;
$model->root = $last_root+1;
if ($model->save())
	$this->redirect(array('view', 'id' => $model->id));


$last_id = $model->id ;
$last_root = $model->root; 

if( $cat_level>1 ) {
    
    if( $cat_level > $last_level ) {
        $levels_tab[] = array($last_parent_id , $last_parent_root);
        $last_parent_id = $last_id;
        $last_parent_root = $last_root;
        $last_level = $cat_level;
    }
    
    if( $cat_level < $last_level ) {
        
        list($last_parent_id, $last_parent_root) = array_pop ($levels_tab);
        $last_level = $cat_level;
        
    }


    $_POST['moved_node'] = $model->id ;
    $_POST['new_parent'] = $last_parent_id;
    $_POST['new_parent_root'] = $last_parent_root;

    JsTreeBehavior::actionMoveCopy();
    
    

	
    }
    
    }
}