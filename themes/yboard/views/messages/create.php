<?php
/* @var $this MessagesController */
/* @var $model Messages */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Messages', 'url'=>array('index')),
	array('label'=>'Manage Messages', 'url'=>array('admin')),
);

//var_dump(User::model()->findByPk($receiver)->id);


?>

<div><?=t('Write messages to')?> 
    <a href='<?=Yii::app()->createUrl('user/view',array('id'=>$receiver))?>'> 
        <?=User::model()->findByPk($receiver)->username?>
    </a>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>