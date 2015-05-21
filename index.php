<?php
header("Content-Type: text/html; charset=UTF-8");

if($_COOKIE['YII_DEBUG']==="true") {
    // Подключение параметров для режима отладки 
	$yii=dirname(__FILE__).'/../framework/yii.php';
	$CONFIG=dirname(__FILE__).'/protected/config/main_dev.php';
	
	//Настройка вывода сообщений
	error_reporting(E_ALL^E_NOTICE);
	ini_set("display_errors",1);
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
