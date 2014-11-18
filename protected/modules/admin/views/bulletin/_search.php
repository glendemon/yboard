<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'),
    ));
    ?>

    <div class="row">
<?php echo $form->label($model, 'id'); ?>
<?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'user_id'); ?>
<?php echo $form->textField($model, 'user_id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'category_id'); ?>
<?php echo $form->textField($model, 'category_id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'type'); ?>
<?php echo $form->checkBox($model, 'type'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'views'); ?>
<?php echo $form->textField($model, 'views'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'text'); ?>
<?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row buttons">
      <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->