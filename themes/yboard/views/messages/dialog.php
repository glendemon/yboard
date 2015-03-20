<?php
/* @var $this MessagesController */
/* @var $dataProvider CActiveDataProvider */
/* @var $userData CActiveRecord User */
/* @var $model CActiveRecord Messages */
?>

<h4><?=t('Dialog')?> с 
    <a href='<? echo Yii::app()->createUrl('user/user/view/', array('id'=>$userData->id))?>'>
            <?=$userData->username?></a>
</h4>

<div class='dialog'>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'receiver'=>$userData->id)); ?>