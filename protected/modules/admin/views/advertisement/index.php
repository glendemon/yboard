<?php
/* @var $this AdvertisementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    AdminModule::t('Advertisements'),
);

$this->menu = array(
    array('label' => AdminModule::t('Create Advertisement'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Manage Advertisement'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Advertisements'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
