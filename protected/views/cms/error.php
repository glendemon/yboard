<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $error->exception->statusCode; ?></h2>

<div class="error">
<?php echo CHtml::encode($error->exception->getMessage()); ?>
</div>