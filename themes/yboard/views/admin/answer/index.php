<?php
/* @var $this AnswerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    AdminModule::t('Answers'),
);

$this->menu = array(
    array('label' => AdminModule::t('Create Answer'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Answers'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
