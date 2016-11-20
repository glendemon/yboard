<?php

header("Content-Type: text/html; charset=UTF-8");

if (isset($_COOKIE['YII_DEBUG'])) {

    //Настройка вывода сообщений
    error_reporting(E_ALL ^ E_NOTICE);
    ini_set("display_errors", 1);
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
} else {
    // Отключение вывода сообщений
    error_reporting(E_WARNING);
    ini_set("display_errors", 0);
}

// Подключение параметров для режима отладки 
$yii = dirname(__FILE__) . '/../framework/yii.php';
$CONFIG = dirname(__FILE__) . '/protected/config/main_conf.php';

require_once($yii);
Yii::createWebApplication($CONFIG)->run();
