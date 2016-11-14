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

    <?php echo $form->errorSummary($model); ?>

    <div >
        <?php
        //$this->widget('application.widgets.BulletinCategoryWidget', array('model' => $model, 'form' => $form)); 
        ?>
        <?= CHtml::activeHiddenField($model, 'category_id') ?>
        <?php echo $form->labelEx($model, 'category_id'); ?>
        <?php echo CHtml::dropDownList('category_id', 0, CHtml::listData(Category::model()->roots()->findAll(), "id", "name"), array('empty' => t('Choose category'), 'onchange' => 'loadFields(this)'));
        ?>

        <?php echo $form->error($model, 'category_id'); ?>
        <div class='ajax-div'></div>
    </div>

    <div id='bulletin_form' style='display:none;'>

        <div >
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div >
            <?php echo $form->labelEx($model, 'text'); ?>
            <?php echo $form->textArea($model, 'text', array( 'rows' => '6')); ?>
            <?php echo $form->error($model, 'text'); ?>
        </div>

        
        <?php 
        /*
        <div >
            <?php  echo $form->labelEx($model, 'type'); ?>
            <?php
            echo CHtml::activeRadioButtonList($model, 'type', array(
                t('Demand'), t('Offer')), array(
                    'labelOptions' => array(
                        'style' => 'display:inline'), 'separator' => ' '));
            ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
         * 
         */
        ?>
        
        <div >
            <?php echo $form->labelEx($model, 'price'); ?>
            <?php echo $form->textField($model, 'price'); ?>
            <?php echo $form->dropDownList($model, 'currency', $this->settings['currency']); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>

        <div >
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

        <div >
            <?php echo $form->labelEx($model, 'youtube_id'); ?>
            <?php echo $form->textField($model, 'youtube_id'); ?>
            <?php echo $form->error($model, 'youtube_id'); ?>
        </div>

        <div class="row buttons" align='center'>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
        </div>
    </div>
    
<?php $this->endWidget(); ?>

</div><!-- form -->


