<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('lang','Categories'),
);

$this->menu = array(
    array('label' => "<i class='fa fa-folder-open-o'></i>".Yii::t('lang','Create Category'),  'url' => array('create'),"itemOptions"=>array('class'=>'btn')),
	array('label' => "<i class='fa fa-cogs'></i>".Yii::t('lang','Manage Category'), 'url' => array('admin'),"itemOptions"=>array('class'=>'btn')),
	array('label' => "<i class='fa fa-spinner'></i>Обновить древо",  'url' => "javascript:void(0)","itemOptions"=>array('class'=>'btn','id'=>'reload')),
);
?>

<?php

$this->widget('application.widgets.JsTreeWidget', array('modelClassName' => 'Category',
    'jstree_container_ID' => 'Category-wrapper', //jstree will be rendered in this div.id of your choice.
    'themes' => array('theme' => 'apple', 'dots' => true, 'icons' => false),
    'plugins' => array('themes', 'html_data', 'contextmenu', 'crrm', 'dnd', 'cookies', 'ui')    
));
/*
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
 * 
 */
?>


<?php 

?>

