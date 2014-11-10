<?php
/* @var $this AnswerController */
/* @var $model Answer */

$this->breadcrumbs = array(
    AdminModule::t('Answers') => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => AdminModule::t('List Answer'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Answer'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Update Answer'), 'icon' => 'icon-refresh', 'url' => array('update', 'id' => $model->id)),
    array('label' => AdminModule::t('Delete Answer'), 'icon' => 'icon-minus', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => AdminModule::t('Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('View Answer'); ?> #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'parent_id',
        'user_id',
        'text',
        'created_at',
        'updated_at',
    ),
));
?>
