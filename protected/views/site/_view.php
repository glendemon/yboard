<?php
/* @var $this BulletinController */
/* @var $data Bulletin */
?>

<div class="well">
    <table class="table">
        <tr class="alert-info">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
				<?php echo $data->itemAlias('type', $data->type); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
				<?php echo CHtml::link(CHtml::encode($data->name), array('site/bulletin', 'id' => $data->id)); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
				<?php echo CHtml::link(CHtml::encode($data->user->username), array('user/user/view', 'id' => $data->user->id)); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><?php echo CHtml::encode($data->getAttributeLabel('gallery_id')); ?>:</b>
				<?php $this->widget('application.widgets.ShowImagesWidget', array('bulletin' => $data)); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td>  <b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
				<?php echo CHtml::encode($data->text); ?>
            </td>
        </tr>
		<tr class="alert-block">
            <td><?php
				$this->widget('bootstrap.widgets.TbButton', array(
					'label' => 'Показать полностью',
					'type' => 'primary',
					'size' => 'null',
					'url' => array('site/bulletin', 'id' => $data->id)
				));
				?>
            </td>
        </tr>

    </table>
</div>