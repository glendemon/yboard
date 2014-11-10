<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs = array(
    AdminModule::t('Advertisements') => array('index'),
    AdminModule::t('Create'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Advertisement'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Manage Advertisement'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php AdminModule::t('Create Advertisement'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>