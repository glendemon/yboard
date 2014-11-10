<?php
/* @var $this AnswerController */
/* @var $data Answer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo $data->user ? CHtml::link(CHtml::encode($data->user->username), array('user/user/view', 'id'=>$data->user->id)) : ''; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

    <?php if (!empty($data->answers)): ?>
    <?php foreach ($data->answers as $answer): ?>
    <div class="answer well">
        <?php echo CHtml::encode($answer->text); ?>
    </div>
    <?php endforeach; ?>
    <?php elseif ($this->canUserReply()): ?>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'Answer',
            'action' => $this->createUrl('create'),
            'htmlOptions'=>array('class'=>'well'),
        )); ?>

        <?php echo CHtml::textArea('Answer[text]', '', array('class'=>'span3')); ?>
        <?php echo CHtml::hiddenField('Answer[parent_id]', $data->id); ?>
        <br />
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>Yii::t('main', 'Reply'))); ?>
        <?php $this->endWidget(); ?>

    <?php endif; ?>

</div>