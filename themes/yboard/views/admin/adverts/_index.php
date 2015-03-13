<?php
/* @var $this BulletinController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('lang','Bulletins'),
);

$this->menu = array(
    array('label' => Yii::t('lang','Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang','Manage Bulletin'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','Bulletins'); ?></h1>

<table>
	
<tr class="alert-info">
	<th>
	<td><?php echo CHtml::encode($data->getAttributeLabel('id')); ?></td>
	<td><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::encode($data->name); ?>
	</td>

	<td><b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
		<?php echo CHtml::encode($data->user_id); ?>
	</td>

	<td><b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
		<?php echo CHtml::encode($data->category_id); ?>
	</td>

	<td><b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
		<?php echo CHtml::encode($data->type); ?>
	</td>

	<td><b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
		<?php echo CHtml::encode($data->views); ?>
	</td>
	<td><b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
		<?php echo CHtml::encode($data->text); ?>
	</td>
</th>
<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
