<?php

/* @var $this MessagesController */
/* @var $data Messages */

?>

<div class="view mes_dialog">

    <b> <?php echo CHtml::encode($data->sender->username); ?></b> 
    <i class='mesDate' style='font-size:10px; '>
        (<?php echo PeopleDate::format($data->send_date); ?>)
    </i>  :
    <br/>
    <? echo $data->message; ?>

</div>