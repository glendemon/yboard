<?php
$this->pageTitle = Yii::app()->name . ' - ' . t("Login");
$this->breadcrumbs = array(
    t("Login"),
);
?>

<h1><?php echo t("Login"); ?></h1>

<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>

<p><?php echo t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form well">
    <?php echo CHtml::beginForm(); ?>

    <p class="note"><?php echo t('Fields with <span class="required">*</span> are required.'); ?></p>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'username'); ?>
        <?php echo CHtml::activeTextField($model, 'username') ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'password'); ?>
        <?php echo CHtml::activePasswordField($model, 'password') ?>
    </div>

    <div class="row">
        <p class="hint">
            <?php echo CHtml::link(t("Register"), Yii::app()->createUrl("registration")); ?> 
            | <?php echo CHtml::link(t("Lost Password?"), Yii::app()->createUrl("recovery")); ?>
        </p>
    </div>

    <div class="row rememberMe">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
    </div>

    <div class="row submit">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Вход')); ?>

    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements' => array(
        'username' => array(
            'type' => 'text',
            'maxlength' => 32,
        ),
        'password' => array(
            'type' => 'password',
            'maxlength' => 32,
        ),
        'rememberMe' => array(
            'type' => 'checkbox',
        )
    ),
    'buttons' => array(
        'login' => array(
            'type' => 'submit',
            'label' => 'Login',
        ),
    ),
        ), $model);
?>