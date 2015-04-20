<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs=array(
	'Добавить объявление',
);

?>

<h1>Добавить объявление</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
