<?php
/* @var $this BulletinController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    AdminModule::t('Bulletins'),
);

$this->menu = array(
    array('label' => AdminModule::t('Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Bulletins'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
