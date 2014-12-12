<?php
/* @var $this CategoryController */
/* @var $data Category */
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
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('icon')); ?>:</b>
                <?php echo CHtml::encode($data->icon); ?>
            </td>
        </tr>
    </table>

</div>