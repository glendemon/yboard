<!--
 /**
  * Form for JsTreeBehavior model.
  *
  * Date: 1/29/13
  * Time: 12:00 PM
  *
  * @author: Spiros Kabasakalis <kabasakalis@gmail.com>
  * @link http://iws.kabasakalis.gr/
  * @link http://www.reverbnation.com/spiroskabasakalis
  * @copyright Copyright &copy; Spiros Kabasakalis 2013
  * @license http://opensource.org/licenses/MIT  The MIT License (MIT)
  * @version 1.0.0
  */
-->

<?php if ($model->isNewRecord) : ?>
    <h3><?php echo Yii::t('global', 'Create') ?> <?php echo Yii::t('global', $modelClassName) ?></h3>
<?php elseif (!$model->isNewRecord): ?>
    <h3><?php echo Yii::t('global', 'Update') ?> <?php echo Yii::t('global', $modelClassName) ?></h3>
<?php endif; ?>

<p> <h2><?php //echo $model->name; ?></h2></p>

<?php
$val_error_msg = Yii::t('global', "Error.$modelClassName  was not saved.");
$val_success_message = ($model->isNewRecord) ?
    Yii::t('global', "$modelClassName has been created successfully.") :
    Yii::t('global', "$modelClassName  has been updated successfully.");
?>

<div id="success-note" class="alert alert-success"
     style="display:none;">
<?php echo $val_success_message; ?>
</div>

<div id="error-note" class="alert alert-error"
     style="display:none;">
<?php echo $val_error_msg; ?>
</div>

<div id="ajax-form" class='form'>
    <?php
    $formId = "$modelClassName-form";

    $actionUrl = ($model->isNewRecord) ?
        ( ( (!empty($_POST['create_root']) ? $_POST['create_root'] : '') != 'true') ? CController::createUrl($this->id . '/createnode') : CController::createUrl($this->id . '/createRoot')) :
        CController::createUrl($this->id . '/updatenode');

    $form = $this->beginWidget('CActiveForm', array(
        'id' => $formId,
        //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
        'action' => $actionUrl,
        // 'enableAjaxValidation'=>true,
        'enableClientValidation' => true,
        'focus' => array($model, 'name'),
        'errorMessageCssClass' => 'alert alert-error',
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnType' => false,
            'inputContainer' => '.control-group',
            'errorCssClass' => 'error',
            'successCssClass' => 'success',
            'afterValidate' => 'js:function(form,data,hasError){$.js_afterValidate(form,data,hasError);  }',
        ),
        ));
    ?>

    <?php
    echo $form->errorSummary($model, '<div style="font-weight:bold">Please correct these errors:</div>', NULL, array('class' => 'alert alert-error')
    );
    ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <fieldset>


        <!--
        Modify the input fields according to your model.
        -->
        <div class="control-group">
<?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model, 'name', array('value' => !empty($_POST['name']) ? $_POST['name'] : $model->name, 'class' => 'span4', 'size' => 60, 'maxlength' => 128)); ?>
                <p class="help-block"><?php echo $form->error($model, 'name'); ?></p>
            </div>
        </div>

        <div class="control-group">
<?php echo $form->labelEx($model, 'icon', array('class' => 'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model, 'icon', array('value' => !empty($_POST['icon']) ? $_POST['icon'] : $model->icon, 'class' => 'span4', 'size' => 60, 'maxlength' => 128)); ?>
                <p class="help-block"><?php echo $form->error($model, 'icon'); ?></p>
            </div>
        </div>

        <input type="hidden" name="YII_CSRF_TOKEN"
               value="<?php echo Yii::app()->request->csrfToken; ?>"/>
        <input type="hidden" name= "parent_id" value="<?php echo !empty($_POST['parent_id']) ? $_POST['parent_id'] : ''; ?>"  />

<?php if (!$model->isNewRecord): ?>
            <input type="hidden" name="update_id"
                   value=" <?php echo $model->id; ?>"/>
<?php endif; ?>
        <div class="control-group">
               <?php
               echo CHtml::submitButton($model->isNewRecord ? Yii::t('global', 'Submit') : Yii::t('global', 'Save'), array('class' => 'btn btn-large pull-right'));
               ?>
        </div>
    </fieldset>
<?php $this->endWidget(); ?>
</div>
<!-- form -->


