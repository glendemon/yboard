<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $form CActiveForm */
/* @var $model Bulletin 

 * Вудалить
 *  */
?>

		<?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo CHtml::activeDropDownList($model,'category_id', $categories,

            array('empty' => Yii::t('bulletin', 'Choose category'),'onchange'=>'loadFields(this)')); ?>

		<?php echo $form->error($model,'category_id'); ?>