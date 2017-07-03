<?php
/* @var $this MessagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	t('Messages'),
);

$this->menu=array(
	array('label'=>'Create Messages', 'url'=>array('create')),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);

?>

<h4><?=t('Messages')?></h4>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_list',
)); ?>


<?php 

?>

