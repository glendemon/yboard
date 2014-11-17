<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    AdminModule::t('Categories'),
);

$this->menu = array(
    array('label' => AdminModule::t('Create Category'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => AdminModule::t('Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<?php

$this->widget('application.widgets.JsTreeWidget', array('modelClassName' => 'Category',
    'jstree_container_ID' => 'Category-wrapper', //jstree will be rendered in this div.id of your choice.
    'themes' => array('theme' => 'default', 'dots' => true, 'icons' => false),
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
