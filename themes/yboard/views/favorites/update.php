<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

$this->breadcrumbs=array(
	'Favorites'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Favorites', 'url'=>array('index')),
	array('label'=>'Create Favorites', 'url'=>array('create')),
	array('label'=>'View Favorites', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Favorites', 'url'=>array('admin')),
);
?>

<h1>Update Favorites <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>