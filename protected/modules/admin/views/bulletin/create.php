<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    AdminModule::t('Bulletins') => array('index'),
    AdminModule::t('Create'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Create Bulletin'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>