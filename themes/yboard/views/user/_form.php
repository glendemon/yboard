<?php
/* @var $this ReviewsController */
/* @var $model Reviews */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reviews-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?=t('Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div >
		<?php echo $form->labelEx($model,'full_name'); ?>
		<?php echo $form->textField($model,'full_name'); ?>
		<?php echo $form->error($model,'full_name'); ?>
	</div>

	<div >
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location'); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>
        <div >
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone', array('pattern' => '\+?[-0-9]+')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
        <div >
		<?php echo $form->labelEx($model,'skype'); ?>
		<?php echo $form->textField($model,'skype'); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>
        <div >
		<?php echo $form->labelEx($model,'contacts'); ?>
		<?php echo $form->textField($model,'contacts'); ?>
		<?php echo $form->error($model,'contacts'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? t('Create') : t('Save'),array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->