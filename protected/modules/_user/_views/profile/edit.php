<?php
$this->pageTitle = Yii::app()->name . ' - ' . t("Profile");
$this->breadcrumbs = array(
    t("Profile") => array('profile'),
    t("Edit"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')) : array()),
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
    array('label' => t('Profile'), 'icon' => 'icon-user', 'url' => array('/user/profile')),
    array('label' => t('Change password'), 'icon' => 'icon-edit', 'url' => array('changepassword')),
    array('label' => t('Logout'), 'icon' => ' icon-off', 'url' => array('/user/logout')),
);
?><h1><?php echo t('Edit profile'); ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'profile-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note"><?php echo t('Fields with <span class="required">*</span> are required.'); ?></p>

    <?php echo $form->errorSummary(array($model, $profile)); ?>

    <?php
    $profileFields = $profile->getFields();
    if ($profileFields) {
        foreach ($profileFields as $field) {
            ?>
            <div class="row">
                <?php
                echo $form->labelEx($profile, $field->varname);

                if ($widgetEdit = $field->widgetEdit($profile)) {
                    echo $widgetEdit;
                } elseif ($field->range) {
                    echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
                } elseif ($field->field_type == "TEXT") {
                    echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
                } else {
                    echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
                }
                echo $form->error($profile, $field->varname);
                ?>
            </div>	
            <?php
        }
    }
    ?>
    <div class="row">
<?php echo $form->labelEx($model, 'username'); ?>
<?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>

    <div class="row">
<?php echo $form->labelEx($model, 'email'); ?>
<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? t('Create') : t('Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
