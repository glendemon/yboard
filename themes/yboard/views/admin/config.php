<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Настройки';
$this->breadcrumbs=array(
	'Настройки',
);
?>

<h1>Настройки</h1>
<div align='right'> <a href='<?=$this->createUrl("site/reset")?>'> Вернуть значения по умолчанию </a></div>
<div class="form" method='post'>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
)); ?>

<? 
foreach($model->atribute as $n=>$m) {
	echo ("<fieldset><legend>".$m."</legend>");

	foreach($model->config[$n] as $nc=>$vc){
		echo "<div><span> ".$nc." </span> <input type='text' name='config[".$n."][".$nc."]'  value='".$vc."' /> <a class='icon-remove' href='javascript:void(0)' onclick='removeOption(this)' ></a></div>";
	}
	echo "<a class='icon-plus' href='javascript:void(0)' onclick='addOption(this,\"".$n."\")' > Добавить опцию</a></fieldset>";
}

?>
<input type='submit' class='btn btn-info' value='Сохранить' />
<?php $this->endWidget(); ?>
</div><!-- form -->