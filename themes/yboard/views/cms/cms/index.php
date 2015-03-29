<?php
$this->breadcrumbs=array(
	'Cms',
);

$this->menu=array(
	array('label'=>'Create Cms', 'url'=>array('create')),
	array('label'=>'Manage Cms', 'url'=>array('admin')),
);
?>

<h1>Cms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
