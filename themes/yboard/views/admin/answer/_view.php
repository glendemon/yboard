<?php
/* @var $this AnswerController */
/* @var $data Answer */
?>

<div class="view well">
    <table class="table">
        <tr class="alert-info">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
                <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('parent_id')); ?>:</b>
                <?php echo CHtml::encode($data->parent_id); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
                <?php echo CHtml::encode($data->user_id); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
                <?php echo CHtml::encode($data->text); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
                <?php echo CHtml::encode($data->created_at); ?>
            </td>
        </tr>
        <tr class="alert-block">
            <td><b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
                <?php echo CHtml::encode($data->updated_at); ?>
            </td>
        </tr>
    </table>

</div>