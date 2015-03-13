<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    Yii::t('lang','Bulletins') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    Yii::t('lang','Update'),
);

$this->menu = array(
    array('label' => Yii::t('lang','List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang','Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang','View Bulletin'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('lang','Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','Update Bulletin'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>