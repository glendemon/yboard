<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs = array(
    AdminModule::t('Advertisements') => array('index'),
    AdminModule::t($model->name) => array('view', 'id' => $model->id),
    AdminModule::t('Update'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Advertisement'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Advertisement'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('View Advertisement'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => AdminModule::t('Manage Advertisement'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Update Advertisement'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>