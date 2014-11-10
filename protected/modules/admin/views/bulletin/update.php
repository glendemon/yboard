<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    AdminModule::t('Bulletins') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    AdminModule::t('Update'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('View Bulletin'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => AdminModule::t('Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Update Bulletin'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>