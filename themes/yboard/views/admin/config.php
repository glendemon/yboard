<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Настройки';
$this->breadcrumbs = array(
    'Настройки',
);
?>

<h1>Настройки</h1>
<div align='right'> <a href='<?= $this->createUrl("site/reset") ?>'> Вернуть значения по умолчанию </a></div>
<div class="form" method='post'>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => false,
    ));
    ?>

    <?
    foreach ($model->atribute as $n => $m) {
        if (strpos($m, "[static]") !== false) {
            $m = str_replace("[static]", "", $m);
            $static = true;
        } else {
            $static = false;
        }

        echo ("<fieldset class='config-block'><legend>" . $m . "</legend>");
        
        if(is_array($model->config[$n])) {
        foreach ($model->config[$n] as $nc => $vc) {
            echo "<div>";
            if (!is_numeric($nc)) {
                echo "<span> " . $nc . " </span> ";
            }
            echo "<input type='text'  atr_id='".$nc."' name='config[" . $n . "][" . $nc . "]'  value='" . $vc . "' /> ";
            if (!$static) {
                echo "<a class='icon-remove' href='javascript:void(0)' onclick='removeOption(this)' ></a>";
            }
            echo "</div>";
        }
        if (!$static) {
            echo "<a class='icon-plus admin-settings' href='javascript:void(0)' "
            . "onclick='addOption(this,\"" . $n . "\")' >"
            . " Добавить опцию</a>";
        }
        } else {
             echo "<input type='text'  atr_id='".$nc."' name='config[" . $n . "]'  value='" . $model->config[$n] . "' /> ";
        }
        echo "</fieldset>";
    }
    ?>
    <input type='submit' class='btn btn-info' value='Сохранить' />
    <?php $this->endWidget(); ?>
</div><!-- form -->