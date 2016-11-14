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




<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th colspan="5">
                Топ объявлениий:
            </th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($IndexAdv as $model): ?>
            <tr>
                <td>
                    <?php if ($model->getPhoto()): ?>
                        <img src="<?php echo $model->getPhoto()->getPreview(); ?>" width="150" alt="<?php echo CHtml::encode($model->name) ?>" />
    <?php endif; ?>
                </td>
                <td><?php echo CHtml::link(CHtml::encode($model->category->name), array('/adverts/category', 'cat_id' => $model->category->id)); ?></td>
                <td><?php echo CHtml::link(CHtml::encode($model->name), array('/adverts/view', 'id' => $model->id)); ?></td>
                <td><?php echo Yii::app()->dateFormatter->formatDateTime($model->created_at); ?></td>
                <td><?php echo $model->itemAlias('type', $model->type); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

