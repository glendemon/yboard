<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cms-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    
	<?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'parent_id'); ?>
	<?php echo $form->hiddenField($model,'url'); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <?php
        $this->publishJS();
        $this->initTranslit();
    ?>

    <table style="width:auto;margin:0;">
        <tr>
            <td>
                <?php echo $form->labelEx($model,'layout'); ?>
                <?php echo $form->dropDownList($model,'layout',$model->layouts,array('empty'=>'')); ?>
                <?php echo $form->error($model,'layout'); ?>
            </td>
            <td>                 
                <?php echo $form->labelEx($model,'section'); ?>
                <?php echo $form->dropDownList($model,'section',$model->sections,array('empty'=>'')); ?>
                <?php echo $form->error($model,'section'); ?>
            </td>
            <td>                                                    
                <?php echo $form->labelEx($model,'subsection'); ?>
                <?php echo $form->dropDownList($model,'subsection',$model->subsections,array('empty'=>'')); ?>
                <?php echo $form->error($model,'subsection'); ?>
            </td>
        </tr>
    </table>
    
    <div class="row">
        <?php echo $form->labelEx($model,'access_level'); ?>
        <?php echo $form->dropDownList($model,'access_level',$model->getAccessLevels()); ?>
        <?php echo $form->error($model,'access_level'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php 
        if ($this->FckEditorAvailable(0)){
            $this->widget('application.extensions.ckeditor.CKEditor', array(
            'model'=>$model,
            'attribute'=>'content',
            //'language'=>'ru',
            'editorTemplate'=>'full',//'basic'
            'skin' => 'v2'
            ));
        } else echo $form->textArea($model,'content',array('rows'=>6,'cols'=>50));
         ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'keywords'); ?>
        <?php echo $form->textArea($model,'keywords',array('rows'=>1, 'cols'=>50)); ?>
        <?php echo $form->error($model,'keywords'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>1, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
    <?php echo CHtml::hiddenField('type',Cms::PAGE); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->