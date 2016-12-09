<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;

if(!$results) {
    echo "<div class='results'>".t("No results for full search. Show simplified search results:")."</div>";
}

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$data,
	'itemView'=>'_view',
        'ajaxUpdate'=>false,
)); ?>

