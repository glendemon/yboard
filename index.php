<?php

header("Content-Type: text/html; charset=UTF-8");
// change the following paths if necessary
$yii=dirname(__FILE__).'/yii_framework/yii.php';


if($_COOKIE['YII_DEBUG']==="yes") {

	// remove the following lines when in production mode
	defined('YII_DEBUG') or define('YII_DEBUG',true);
	// specify how many levels of call stack should be shown in each log message
	defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
	$CONFIG=dirname(__FILE__).'/protected/config/main_dev.php';
} else {
	$CONFIG=dirname(__FILE__).'/protected/config/main.php';
}


require_once($yii);
Yii::createWebApplication($CONFIG)->run();
