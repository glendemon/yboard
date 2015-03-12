<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs = array(
    Yii::t('lang','Categories') => array('index'),
    Yii::t('lang','Create'),
);

$this->menu = array(
    array('label' => Yii::t('lang','List Category'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang','Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','Create Category'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>