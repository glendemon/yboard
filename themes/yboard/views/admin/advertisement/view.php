<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs = array(
    AdminModule::t('Advertisements') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => AdminModule::t('List Advertisement'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Advertisement'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Update Advertisement'), 'icon' => 'icon-refresh', 'url' => array('update', 'id' => $model->id)),
    array('label' => AdminModule::t('Delete Advertisement'), 'icon' => 'icon-minus', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => AdminModule::t('Manage Advertisement'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('View Advertisement'); ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'banner',
        'url',
        'name',
        'description',
        'order',
        'gallery_id',
    //'extra',
    ),
));
?>
