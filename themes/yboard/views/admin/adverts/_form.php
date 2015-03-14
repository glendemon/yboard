<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
/* @var $form CActiveForm */
/* @var $categories array */
?>

<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'bulletin-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
        <?php echo $form->textField($model, 'user_id'); ?>
        <?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php $this->widget('application.widgets.BulletinCategoryWidget', array('model' => $model, 'form' => $form)); ?>
    </div>

    <div class="row">
        <?php $this->widget('application.widgets.BulletinTypeWidget', array('model' => $model, 'form' => $form)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'views'); ?>
        <?php echo $form->textField($model, 'views'); ?>
        <?php echo $form->error($model, 'views'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row buttons">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->