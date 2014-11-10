<?php
/* @var $this AnswerController */
/* @var $model Answer */

$this->breadcrumbs = array(
    AdminModule::t('Answers') => array('index'),
    AdminModule::t('Create'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Answer'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo AdminModule::t('Create Answer'); ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>