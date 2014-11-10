<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $form CActiveForm */
/* @var $model Bulletin */
?>

		<?php echo $form->labelEx($model,'type'); ?>
        <?php echo CHtml::activeRadioButtonList($model,'type',
            array(Yii::t('bulletin','Demand'), Yii::t('bulletin','Offer')),
            array('labelOptions'=>array('style'=>'display:inline'), 'separator'=>' ')
            ); ?>
		<?php echo $form->error($model,'type'); ?>