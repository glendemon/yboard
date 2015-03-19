<?php
$this->pageTitle = Yii::app()->name . ' - ' . t("Change Password");
$this->breadcrumbs = array(
    t("Profile") => array('/user/profile'),
    t("Change Password"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')) : array()),
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
    array('label' => t('Profile'), 'icon' => 'icon-user', 'url' => array('/user/profile')),
    array('label' => t('Edit'), 'icon' => 'icon-pencil', 'url' => array('edit')),
    array('label' => t('Logout'), 'icon' => ' icon-off', 'url' => array('/user/logout')),
);
?>

<h1><?php echo t("Change password"); ?></h1>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'changepassword-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note"><?php echo t('Fields with <span class="required">*</span> are required.'); ?></p>
<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'oldPassword'); ?>
        <?php echo $form->passwordField($model, 'oldPassword'); ?>
<?php echo $form->error($model, 'oldPassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
            <?php echo $form->error($model, 'password'); ?>
        <p class="hint">
<?php echo t("Minimal password length 4 symbols."); ?>
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'verifyPassword'); ?>
        <?php echo $form->passwordField($model, 'verifyPassword'); ?>
<?php echo $form->error($model, 'verifyPassword'); ?>
    </div>


    <div class="row submit">
<?php echo CHtml::submitButton(t("Save")); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->