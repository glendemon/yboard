<?php
/* @var $this AdvertisementController */
/* @var $data Advertisement */
?>

<div class="view well">

    <table class="table">
        <tr class="alert-info">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('banner')); ?>:</b>
                <?php echo CHtml::encode($data->banner); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
                <?php echo CHtml::encode($data->url); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
                <?php echo CHtml::encode($data->name); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
                <?php echo CHtml::encode($data->description); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('order')); ?>:</b>
                <?php echo CHtml::encode($data->order); ?>
            </td>
        </tr>

        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('gallery_id')); ?>:</b>
                <?php echo CHtml::encode($data->gallery_id); ?>
            </td>
        </tr>

        <?php /*
          <b><?php echo CHtml::encode($data->getAttributeLabel('extra')); ?>:</b>
          <?php echo CHtml::encode($data->extra); ?>
          <br />

         */ ?>
    </table>
</div>