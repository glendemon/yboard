<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="form well">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
            'block'=>true, // display a larger alert block?
            'fade'=>true, // use transitions?
            'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        )); ?>

    <p class="note"><?php echo AdminModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'top'); ?>
        <?php
        $bulletins = Yii::app()->db->createCommand()
                ->select('id, name')
                ->from(Bulletin::model()->tableName())->queryAll();
        echo $form->listBox($model, 'top', CHtml::listData($bulletins, 'id', 'name'), array('multiple' => 'true', 'size' => 10));
        ?>
        <?php echo $form->error($model,'top'); ?>
	</div>

    <div class="row buttons">
	  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->