<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    AdminModule::t('Categories') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    AdminModule::t('Update'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Category'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Category'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('View Category'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => AdminModule::t('Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Update Category'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>