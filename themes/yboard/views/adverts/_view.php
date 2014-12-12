<?php
/* @var $this BulletinController */
/* @var $data Bulletin */
?>

<div class="well">
	<div style='float:left; width: 150px; height: 100px; overflow:hidden;'>
		<?php if ($data->gallery && $data->gallery->galleryPhotos){ ?>
			<?php
			$this->widget('application.extensions.fancybox.EFancyBox', array(
				'target' => '.fancybox',
				'config' => array(),
				)
			);
			?>
			<?php foreach($data->gallery->galleryPhotos as $model){ ?>
				<a href="<?php echo $model->getUrl(); ?>" class="fancybox" rel="<?php echo CHtml::encode($data->id) ?>">
					<img src="<?php echo $model->getPreview(); ?>" width="150" alt="<?php echo CHtml::encode($data->name) ?>" />
				</a>
			<?php } 
			
			} ?>
	</div>
	<div style='margin-left:160px'>
		<div><?php echo CHtml::link(CHtml::encode($data->name), array('site/bulletin', 'id' => $data->id)); ?></div>
		<div><?php echo CHtml::encode($data->text); ?></div>
		<div>
			<?php echo $data->itemAlias('type', $data->type); ?> 
			<?php echo CHtml::link(CHtml::encode($data->user->username), array('user/user/view', 'id' => $data->user->id)); ?>
		</div>
	</div>
    <table class="table" style='display:none'>
        <tr class="alert-info">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
                
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
                
            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
                
            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><?php echo CHtml::encode($data->getAttributeLabel('gallery_id')); ?>:</b>
                
            </td>
        </tr>
        <tr class="alert-block">
            <td>  <b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
                
            </td>
        </tr>
    </table>
</div>