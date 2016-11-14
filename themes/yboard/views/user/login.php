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


<div class="form well">
    <h3><?=t('Social networks authorisation :')?></h3>
    <?
    $this->widget('application.widgets.UloginWidget', array(
        'params' => array(
            'redirect' => Yii::app()->baseUrl . '/index.php?r=login/ulogin' //Адрес, на который ulogin будет редиректить браузер клиента. Он должен соответствовать контроллеру ulogin и действию login
        )
    ));
    ?>
    
    <hr/>
     <h3><?=t('Authorisation for members:')?></h3>

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div >
        <?php echo CHtml::activeLabel($model, 'username'); ?>
        <?php echo CHtml::activeTextField($model, 'username') ?>
    </div>

    <div >
        <?php echo CHtml::activeLabel($model, 'password'); ?>
        <?php echo CHtml::activePasswordField($model, 'password') ?>
    </div>
    
    <div class=" rememberMe">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabel($model, 'rememberMe'); ?>
    </div>

    <div >
        <p class="hint">
            <?php echo CHtml::link(t("Register"), Yii::app()->getModule('user')->registrationUrl); ?> | <?php echo CHtml::link(t("Lost Password?"), Yii::app()->getModule('user')->recoveryUrl); ?>
        </p>
    </div>

    

    <div class=" submit">
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