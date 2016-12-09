<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id' => 'verticalForm',
		'htmlOptions' => array('class' => 'well'),
	));
?>

<h1> Установка Ybord </h1>

<?php echo $form->errorSummary($model); ?>
<p style='color:#ff0000; padding:15px; '><?=$db_error?></p>


<fieldset>
    <label> Данные создаваемого проекта </label>
<div style='padding-left:20px;'> 
    <?php echo $form->labelEx($model, 'site_name'); ?>
    <?php echo $form->textField($model, 'site_name'); ?>
</div>
</fieldset>


<fieldset>
<label> Данные администратора </label>
<div style='padding-left:20px;'> 
    <?php echo $form->labelEx($model, 'username'); ?>
    <?php echo $form->textField($model, 'username'); ?>
    <?php echo $form->error($model, 'username'); ?>
    

    <?php echo $form->labelEx($model, 'userpass'); ?>
    <?php echo $form->textField($model, 'userpass'); ?>
    <?php echo $form->error($model, 'userpass'); ?>
    
    <?php echo $form->labelEx($model, 'userpass2'); ?>
    <?php echo $form->textField($model, 'userpass2'); ?>
    <?php echo $form->error($model, 'userpass2'); ?>

    <?php echo $form->labelEx($model, 'useremail'); ?>
    <?php echo $form->textField($model, 'useremail'); ?>
    <?php echo $form->error($model, 'useremail'); ?>
</div>
</fieldset>

<fieldset>
<label> Данные для подключения к базе данных </label>
<div style='padding-left:20px;'> 
    <?php echo $form->labelEx($model, 'mysql_server'); ?>
    <?php echo $form->textField($model, 'mysql_server'); ?>
    <?php echo $form->error($model, 'mysql_server'); ?>

    <?php echo $form->labelEx($model, 'mysql_db_name'); ?>
    <?php echo $form->textField($model, 'mysql_db_name'); ?>
    <?php echo $form->error($model, 'mysql_db_name'); ?>

    <?php echo $form->labelEx($model, 'mysql_login'); ?>
    <?php echo $form->textField($model, 'mysql_login'); ?>
    <?php echo $form->error($model, 'mysql_login'); ?>

    <?php echo $form->labelEx($model, 'mysql_password'); ?>
    <?php echo $form->textField($model, 'mysql_password'); ?>
    <?php echo $form->error($model, 'mysql_password'); ?>
</div>
</fieldset>

<br/>


<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>


<?php $this->endWidget(); ?>