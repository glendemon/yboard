<?php
$this->breadcrumbs=array(
	'Cms'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
    array('label'=>t('View')." ".$model->name, 'url'=>array('view','id'=>$model->id)),
	array('label'=>t('List pages'), 'url'=>array('index')),
);
?>

<h1><?=t('Update')?> <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('forms/'.$this->getFormPartial($model), array('model'=>$model)); ?>