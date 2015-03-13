<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$data,
	'itemView'=>'_view',
)); ?>


