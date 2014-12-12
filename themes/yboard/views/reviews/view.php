<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reviews', 'url'=>array('index')),
	array('label'=>'Create Reviews', 'url'=>array('create')),
	array('label'=>'Update Reviews', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reviews', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reviews', 'url'=>array('admin')),
);
?>

<h1>View Reviews #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'profile_id',
		'user_id',
		'type',
		'review',
		'vote',
	),
)); ?>
