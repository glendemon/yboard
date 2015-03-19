<?php
/* @var $this MessagesController */
/* @var $data Messages */
?>

<div class="view mes_list">


    <i class='mesDate' style='float:right; font-size:12px; '>
        <?php echo PeopleDate::format($data['last_date']); ?>
    </i>

    <a href='<? echo Yii::app()->createUrl('messages/dialog', array('user'=>$data['interlocutor'])); ?>'> <b><?php echo CHtml::encode($data['username']); ?></b> </a>
    <br/>
    Сообщений (<?php echo CHtml::encode($data['count_mes']); ?>)

</div>