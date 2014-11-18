<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $form CActiveForm */
/* @var $model CModel */
?>

		<?php echo $form->labelEx($model,$attribute); ?>
        <?php if ($preview): ?>
        <img src="<?php echo $preview; ?>" alt="<?php echo $attribute; ?>" />
        <?php endif; ?>
		<?php echo $form->fileField($model,$attribute); ?>
		<?php echo $form->error($model,$attribute); ?>

