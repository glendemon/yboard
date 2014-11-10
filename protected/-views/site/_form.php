<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
/* @var $form CActiveForm */
/* @var $categories array */
?>

<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'bulletin-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note"><?php echo Yii::t('bulletin', 'Fields with <span class="required">*</span> are required.'); ?></p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
<?php $this->widget('application.widgets.BulletinCategoryWidget', array('model' => $model, 'form' => $form)); ?>
    </div>

    <div class="row">
<?php $this->widget('application.widgets.BulletinTypeWidget', array('model' => $model, 'form' => $form)); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gallery_id'); ?>
        <?php
        $this->widget('CMultiFileUpload', array(
            'name' => 'images',
            'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
            'duplicate' => 'Duplicate file!', // useful, i think
            'denied' => 'Invalid file type', // useful, i think
            'max' => 5,
        ));
        ?>
<?php echo $form->error($model, 'gallery_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'youtube_id'); ?>
<?php echo $form->fileField($model, 'youtube_id'); ?>
<?php echo $form->error($model, 'youtube_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
<?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="row buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->