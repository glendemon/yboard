<?php
$this->breadcrumbs=array(
	'Cms'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Cms', 'url'=>array('admin')),
);

?>

<h1>Create <?php echo $model->getPageType($_GET['type']);  ?></h1>

<?php echo $this->renderPartial('forms/'.$this->getFormPartial(), array('model'=>$model)); ?>