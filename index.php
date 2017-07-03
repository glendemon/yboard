<?php
header("Content-Type: text/html; charset=UTF-8");

// Path to Yii framework
$yii = dirname(__FILE__) . '/framework/yii.php';
// Path to config folder
define("BASEPATH",dirname(__FILE__) . '/protected/');

if( !is_file( $yii ) ){
	die(" Yii framework it's not installed. ");
}
if( is_file( dirname(__FILE__) . '/install' ) ){
	$error = false;
	if(  !is_writable( dirname(__FILE__) . '/protected/runtime' )  ){
		echo("'/protected/runtime' not writable <br/>");
		$error = true;
	}
	if(  !is_writable( dirname(__FILE__) . '/assets' )  ){
		echo("'/assets' not writable <br/>");
		$error = true;	
	}
	if(  !is_writable( dirname(__FILE__) . '/protected/config/main_conf.php' )  ){
		echo("'/protected/config/main_conf.php' not writable <br/>");
		$error = true;	
	}
	if(  !is_writable( dirname(__FILE__) . '/protected/config/settings.php' )  ){
		echo("'/protected/config/settings.php' not writable <br/>");
		$error = true;	
	}
	if(  !is_writable( dirname(__FILE__) . '/protected/config/install') and is_file(dirname(__FILE__) . '/protected/config/install')   ){
		echo("'/protected/config/install' not writable <br/>");
		$error = true;	
	}
	if(  !is_writable( dirname(__FILE__) . '/protected/config' )  ){
		echo("'/protected/config' not writable <br/>");
		$error = true;	
	}

	if($error){
		die("Fix error");
	}
}

if (isset($_COOKIE['YII_DEBUG'])) {
    //Настройка вывода сообщений
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set("display_errors", 1);
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
} else {
    //Отключение вывода сообщений
    error_reporting(E_WARNING);
    ini_set("display_errors", 0);
}

// Подключение параметров для режима отладки 

$CONFIG = dirname(__FILE__) . '/protected/config/main_conf.php';

require_once($yii);
Yii::createWebApplication($CONFIG)->run();
