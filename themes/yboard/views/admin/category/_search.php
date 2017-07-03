<?php
/* @var $this CategoryController */
/* @var $model Category */
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
<?php echo $form->label($model, 'icon'); ?>
<?php echo $form->textField($model, 'icon', array('size' => 60, 'maxlength' => 255)); ?>
    </div>
    
        <div class="row">
<?php echo $form->label($model, 'level'); ?>
<?php echo $form->textField($model, 'level', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row buttons">
      <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->