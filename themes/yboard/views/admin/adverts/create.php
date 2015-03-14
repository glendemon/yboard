<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    Yii::t('lang','Bulletins') => array('index'),
    Yii::t('lang','Create'),
);

$this->menu = array(
    array('label' => Yii::t('lang','List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang','Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','Create Bulletin'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>