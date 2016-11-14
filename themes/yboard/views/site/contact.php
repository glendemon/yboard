<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
/* @var $user User */

$this->pageTitle = Yii::app()->name . ' - Обратная связь';
/*
  $this->breadcrumbs=array(
  'Обратная связь',
  );
 */
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links' => array('', 'Обратная связь'),
));
?>

<h1>Отправить сообщение <?php echo $user ? $user->username : 'администратору'; ?></h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>

    <p>

    </p>

    <div class="form">


        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'verticalForm',
            'htmlOptions' => array('class' => 'well'),
        ));
        ?>


        <p class="note">Поля, обязательные для заполнения, помечены звездочкой (<span class="required">*</span>).</p>

    <?php echo $form->errorSummary($model); ?>

        <div >
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->error($model, 'name'); ?>
        </div>

        <div >
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email'); ?>
    <?php echo $form->error($model, 'email'); ?>
        </div>

        <div >
            <?php echo $form->labelEx($model, 'subject'); ?>
            <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
    <?php echo $form->error($model, 'subject'); ?>
        </div>

        <div >
            <?php echo $form->labelEx($model, 'body'); ?>
            <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
    <?php echo $form->error($model, 'body'); ?>
        </div>

            <?php if (CCaptcha::checkRequirements()): ?>
            <div >
                    <?php echo $form->labelEx($model, 'verifyCode'); ?>
                <div>
                    <?php $this->widget('CCaptcha'); ?>
        <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">Пожалуйста, введите буквы, показанные на картинке выше.
                    <br/>Регистр значение не имеет.</div>
            <?php echo $form->error($model, 'verifyCode'); ?>
            </div>
        <?php endif; ?>

        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>

    <?php $this->endWidget(); ?>
    </div><!-- form -->

<?php endif; ?>