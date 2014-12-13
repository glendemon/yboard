<div class="wide form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
        'id' => 'verticalForm',
        'htmlOptions' => array('class' => 'well'),
    ));
    ?>

    <div class="row">
<?php echo $form->label($model, 'id'); ?>
<?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'username'); ?>
<?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'email'); ?>
<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'activkey'); ?>
<?php echo $form->textField($model, 'activkey', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'create_at'); ?>
<?php echo $form->textField($model, 'create_at'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'lastvisit_at'); ?>
<?php echo $form->textField($model, 'lastvisit_at'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'superuser'); ?>
<?php echo $form->dropDownList($model, 'superuser', $model->itemAlias('AdminStatus')); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'status'); ?>
<?php echo $form->dropDownList($model, 'status', $model->itemAlias('UserStatus')); ?>
    </div>

    <div class="row buttons">
      <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отправить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->