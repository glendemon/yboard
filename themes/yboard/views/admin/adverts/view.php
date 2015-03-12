<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    Yii::t('lang','Bulletins') => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => Yii::t('lang','List Bulletin'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang','Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang','Update Bulletin'), 'icon' => 'icon-refresh', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('lang','Delete Bulletin'), 'icon' => 'icon-minus', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => Yii::t('lang','Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','View Bulletin'); ?> #<?php echo $model->id; ?></h1>

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
