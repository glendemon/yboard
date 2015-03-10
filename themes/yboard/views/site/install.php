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

<p style='color:#ff0000; padding:15px; '><?=$db_error?></p>

<?php echo $form->labelEx($model, 'site_name'); ?>
<?php echo $form->textField($model, 'site_name'); ?>

<?php echo $form->labelEx($model, 'mysql_server'); ?>
<?php echo $form->textField($model, 'mysql_server'); ?>

<?php echo $form->labelEx($model, 'mysql_db_name'); ?>
<?php echo $form->textField($model, 'mysql_db_name'); ?>

<?php echo $form->labelEx($model, 'mysql_login'); ?>
<?php echo $form->textField($model, 'mysql_login'); ?>

<?php echo $form->labelEx($model, 'mysql_password'); ?>
<?php echo $form->textField($model, 'mysql_password'); ?>

<br/>


<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>


<?php $this->endWidget(); ?>