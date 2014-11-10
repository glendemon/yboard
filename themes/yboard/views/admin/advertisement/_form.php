<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */
/* @var $form CActiveForm */
?>

<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'advertisement-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));
    ?>

    <p class="note"><?php echo AdminModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php
        $this->widget('application.widgets.ImageFileUploadWidget', array(
            'model' => $model,
            'form' => $form,
            'attribute' => 'banner',
            'preview' => $model->getBannerUrl(),
        ));
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'url'); ?>
<?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'order'); ?>
<?php echo $form->textField($model, 'order'); ?>
<?php echo $form->error($model, 'order'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
<?php echo $form->textField($model, 'email'); ?>
<?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>
<?php echo $form->textField($model, 'phone'); ?>
<?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contact'); ?>
<?php echo $form->textField($model, 'contact'); ?>
<?php echo $form->error($model, 'contact'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gallery_id'); ?>
        <?php if ($model->galleryBehavior->getGallery() === null): ?>
            <?php
            $this->widget('CMultiFileUpload', array(
                'name' => 'images',
                'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
                'duplicate' => 'Duplicate file!', // useful, i think
                'denied' => 'Invalid file type', // useful, i think
            ));
            ?>
        <?php else: ?>
            <?php echo AdminModule::t('<span style="color:red;">Warning: Direct changes!</span>'); ?>
            <?php
            $this->widget('GalleryManager', array(
                'gallery' => $model->galleryBehavior->getGallery(),
                'controllerRoute' => '/admin/gallery', //route to gallery controller
            ));
            ?>
<?php endif; ?>
<?php echo $form->error($model, 'gallery_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'youtube'); ?>
        <?php if ($model->youtube && is_array($model->youtube)): ?>
            <?php foreach ($model->youtube as $youtube): ?>
                <?php $this->widget('ext.Yiitube', array('v' => $youtube, 'size' => 'small')); ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php
        $this->widget('CMultiFileUpload', array(
            'model' => $model,
            'attribute' => 'youtube',
            'accept' => 'mov|mpeg4|avi|wmv|mpegps|flv|3gpp|webm', // useful for verifying files
            'duplicate' => 'Duplicate file!', // useful, i think
            'denied' => 'Invalid file type', // useful, i think
        ));
        ?>
<?php echo $form->error($model, 'youtube'); ?>
    </div>

    <div class="row buttons">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->