<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Настройки';
$this->breadcrumbs = array(
    'Настройки',
);
?>

<h1>Настройки</h1>

<?php
$this->widget('application.extensions.Configer.Configer', array(
    'configPath' => $configPath
));
?>
