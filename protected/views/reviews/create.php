<?php
/* @var $this ReviewsController */
/* @var $model Reviews */

$this->breadcrumbs=array(
	'Reviews'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reviews', 'url'=>array('index')),
	array('label'=>'Manage Reviews', 'url'=>array('admin')),
);
?>

<h1>Create Reviews</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>