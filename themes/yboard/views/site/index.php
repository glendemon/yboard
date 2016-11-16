<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>


<?php

$ic = 0;
foreach( Yii::app()->params['categories'] as $cat) {
    if($cat['icon'] and $cat['level']==1){
        
        if($ic == 0) { ?>
           <table class="main-cats" cellspacing='10'>
               <tbody> <tr>
        <? }
        if($ic % 3 == 0) { ?>
                   </tr> 
        <? }
                
        echo "<td><div>".CHtml::link("<img src='".Yii::app()->theme->baseUrl."/images/category/".$cat['icon']."' /><span>".$cat['name']."</span>", array('/adverts/category', 'cat_id' => $cat['id']))."</div></td>";
               
        
        $ic ++;
    }
}

?>                   
</tr> </tbody> </table>                   

<h3> Последние объявления </h3>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$IndexAdv,
	'itemView'=>'/adverts/_view',
)); ?>

