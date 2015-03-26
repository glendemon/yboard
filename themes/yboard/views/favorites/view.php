<?php
/* @var $this FavoritesController */
/* @var $model Favorites */

$this->breadcrumbs=array(
	'Favorites'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Favorites', 'url'=>array('index')),
	array('label'=>'Create Favorites', 'url'=>array('create')),
	array('label'=>'Update Favorites', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Favorites', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Favorites', 'url'=>array('admin')),
);
?>

<h1>View Favorites #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'obj_id',
		'obj_type',
	),
)); ?>
