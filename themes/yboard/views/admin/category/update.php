<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    Yii::t('lang','Categories') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    Yii::t('lang','Update'),
);

$this->menu = array(
    array('label' => Yii::t('lang','List Category'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang','Create Category'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang','View Category'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => Yii::t('lang','Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
    array('label' => Yii::t('lang','Удалить категорию'), 'icon' => 'icon-folder-open', 'url' => array('delete', 'id' => $model->id)),
);
?>

<h1><?php echo Yii::t('lang','Update Category'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>