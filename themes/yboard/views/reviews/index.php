<?php
/* @var $this ReviewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reviews',
);

$this->menu=array(
	array('label'=>'Create Reviews', 'url'=>array('create')),
	array('label'=>'Manage Reviews', 'url'=>array('admin')),
);
?>

<h1>Reviews</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
