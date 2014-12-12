<?php
/* @var $this MessagesController */
/* @var $model Messages */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sender_id'); ?>
		<?php echo $form->textField($model,'sender_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receiver_id'); ?>
		<?php echo $form->textField($model,'receiver_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'send_date'); ?>
		<?php echo $form->textField($model,'send_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'read_date'); ?>
		<?php echo $form->textField($model,'read_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->