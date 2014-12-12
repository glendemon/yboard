<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>AdminModule::t('Categories'), 'url'=>array('category/index'),),
        array('label'=>AdminModule::t('Bulletins'), 'url'=>array('bulletin/index')),
        array('label'=>AdminModule::t('Users'), 'url'=>array('/user/user/index')),
        array('label'=>AdminModule::t('Advertisements'), 'url'=>array('advertisement/index')),
        array('label'=>AdminModule::t('Config'), 'url'=>array('config')),
    ),
)); ?>