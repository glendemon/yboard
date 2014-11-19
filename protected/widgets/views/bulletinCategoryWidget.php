<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $form CActiveForm */
/* @var $model Bulletin */
?>

		<?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo CHtml::activeDropDownList($model,'category_id', $categories,
<<<<<<< HEAD
            array('empty' => Yii::t('bulletin', 'Choose category'),'onchange'=>'loadFields()')); ?>
=======
            array('empty' => Yii::t('bulletin', 'Choose category'))); ?>
>>>>>>> origin/master
		<?php echo $form->error($model,'category_id'); ?>