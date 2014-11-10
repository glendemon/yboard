<?php
/* @var $this BulletinController */
/* @var $data Bulletin */
?>

<div class="well">

    <table class="table">
        <tr class="alert-info">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
                <?php echo CHtml::encode($data->name); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
                <?php echo CHtml::encode($data->user_id); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
                <?php echo CHtml::encode($data->category_id); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
                <?php echo CHtml::encode($data->type); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
                <?php echo CHtml::encode($data->views); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
                <?php echo CHtml::encode($data->text); ?>
            </td>
        </tr>
    </table>

</div>