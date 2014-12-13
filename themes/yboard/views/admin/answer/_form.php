<?php
/* @var $this AnswerController */
/* @var $model Answer */
/* @var $form CActiveForm */
?>

<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'answer-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'parent_id'); ?>
<?php echo $form->textField($model, 'parent_id'); ?>
<?php echo $form->error($model, 'parent_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'user_id'); ?>
<?php echo $form->textField($model, 'user_id'); ?>
<?php echo $form->error($model, 'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
<?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'created_at'); ?>
<?php echo $model->created_at; ?>
<?php echo $form->error($model, 'created_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'updated_at'); ?>
<?php echo $model->updated_at; ?>
<?php echo $form->error($model, 'updated_at'); ?>
    </div>

    <div class="row buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->