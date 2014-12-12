<?php
/* @var $this BulletinController */
/* @var $model Bulletin */
/* @var $form CActiveForm */
/* @var $categories array */
?>
<script> 
function loadFields(t){
	$('#Bulletin_category_id').val($(t).val());
	$.get("<?=Yii::app()->baseUrl?>/bulletin/getfields/cat_id/"+$(t).val(),function(data){

		if(data.indexOf('fields_list')!==-1) 
			$("#bulletin_form").show();
		else
			$("#bulletin_form").hide();
		$(t).parent().find('div.ajax-div').html("<div>"+data+"<div class='ajax-div'></div></div>");
	})
}
</script>
<div class="form well">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'bulletin-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
	
	 <?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
		//$this->widget('application.widgets.BulletinCategoryWidget', array('model' => $model, 'form' => $form)); 
		
		
		?>
		

		<?=CHtml::activeHiddenField($model,'category_id')?>
		<?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo CHtml::dropDownList('category_id',0, CHtml::listData(Category::model()->roots()->findAll(),"id","name"),

            array('empty' => Yii::t('bulletin', 'Choose category'),'onchange'=>'loadFields(this)')); ?>

		<?php echo $form->error($model,'category_id'); ?>
		<div class='ajax-div'></div>
	</div>
	
<div id='bulletin_form' style='display:none'>

	<div class="row">
		<?php echo $form->labelEx($model, 'name'); ?>
		<?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model, 'name'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model, 'text'); ?>
		<?php echo $form->textArea($model, 'text', array('style' => 'width:100%', 'rows'=>'6')); ?>
		<?php echo $form->error($model, 'text'); ?>
    </div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo CHtml::activeRadioButtonList($model,'type',
			array(Yii::t('bulletin','Demand'), Yii::t('bulletin','Offer')),
			array('labelOptions'=>array('style'=>'display:inline'), 'separator'=>' ')
			); ?>
		<?php echo $form->error($model,'type'); ?>
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

    <div class="row buttons" align='center'>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->