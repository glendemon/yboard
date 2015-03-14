<?php
/* @var $this MessagesController */
/* @var $data Messages */
?>

<div class="view">

    <div>
        <b><?php echo CHtml::encode($data->getAttributeLabel('sender_id')); ?>:</b>
	<?php echo CHtml::encode($data->sender->username); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('receiver_id')); ?>:</b>
	<?php echo CHtml::encode($data->receiver->username); ?>
	<br />
    </div>

    <br />
    <br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />
        <br />
    
    <div style='font-style:italic'>
        <?php echo CHtml::encode($data->getAttributeLabel('send_date')); ?>:</b>
	<?php echo CHtml::encode($data->send_date); ?>


	<b><?php echo CHtml::encode($data->getAttributeLabel('read_date')); ?>:</b>
	<?php echo CHtml::encode($data->read_date); ?>
    </div>


</div>