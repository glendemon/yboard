<?php
/* @var $this AnswerController */
/* @var $model Answer */

$this->breadcrumbs = array(
    Yii::t('lang','Answers') => array('index'),
    Yii::t('lang','Create'),
);

$this->menu = array(
    array('label' => Yii::t('lang','List Answer'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => Yii::t('lang','Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','Create Answer'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>