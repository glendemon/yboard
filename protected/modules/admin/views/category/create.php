<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    AdminModule::t('Categories') => array('index'),
    AdminModule::t('Create'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Category'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Create Category'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>