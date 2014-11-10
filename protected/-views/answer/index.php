<?php
/* @var $this AnswerController */
/* @var $model Answer */
/** @var BootActiveForm $form */

$this->breadcrumbs=array(
	Yii::t('main', 'Answers'),
);
?>
<h1><?php echo Yii::t('main', 'Answers'); ?></h1>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    )); ?>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    )); ?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'Answer',
    'action' => $this->createUrl('create'),
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->textArea($model, 'text', array('class'=>'span3')); ?>
<br />
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>Yii::t('main', 'Ask'))); ?>

<?php $this->endWidget(); ?>