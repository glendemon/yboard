<?php
$this->pageTitle = Yii::app()->name . ' - ' . t("Restore");
$this->breadcrumbs = array(
    t("Login") => array('/user/login'),
    t("Restore"),
);
?>

<h1><?php echo t("Restore"); ?></h1>

    <?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
    <div class="success">
    <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
    </div>
<?php else: ?>

    <div class="form">
        <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($form); ?>

        <div class="row">
            <?php echo CHtml::activeLabel($form, 'login_or_email'); ?>
    <?php echo CHtml::activeTextField($form, 'login_or_email') ?>
            <p class="hint"><?php echo t("Please enter your login or email addres."); ?></p>
        </div>

        <div class="row submit">
    <?php echo CHtml::submitButton(t("Restore")); ?>
        </div>

    <?php echo CHtml::endForm(); ?>
    </div><!-- form -->
<?php endif; ?>