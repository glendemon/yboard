<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    AdminModule::t('Bulletins') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => AdminModule::t('List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Update Bulletin'), 'icon' => 'icon-refresh', 'url' => array('update', 'id' => $model->id)),
    array('label' => AdminModule::t('Delete Bulletin'), 'icon' => 'icon-minus', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => AdminModule::t('Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('View Bulletin'); ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'user_id',
        'category_id',
        'type',
        'views',
        'text',
    ),
));
?>
