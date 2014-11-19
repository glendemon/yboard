<?php
<<<<<<< HEAD
header("Content-Type: text/html; charset=UTF-8");
// change the following paths if necessary
$yii=dirname(__FILE__).'/yii_framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';


if($_COOKIE['YII_DEBUG']==="yes") {

	// remove the following lines when in production mode
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	// specify how many levels of call stack should be shown in each log message
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
}
=======

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
>>>>>>> origin/master

require_once($yii);
Yii::createWebApplication($config)->run();
