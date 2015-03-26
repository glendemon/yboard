<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

$this->breadcrumbs=array(
	'Favorites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Favorites', 'url'=>array('index')),
	array('label'=>'Manage Favorites', 'url'=>array('admin')),
);
?>

<h1>Create Favorites</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>