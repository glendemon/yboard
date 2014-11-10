<?php
/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $bulletins array */
/* @var $model Bulletin */
?>

<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th colspan="5">
                Топ объявлениий:
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bulletins as $model): ?>
        <tr>
            <td><?php echo $model->itemAlias('type', $model->type); ?></td>
            <td><?php echo Yii::app()->dateFormatter->formatDateTime($model->created_at); ?></td>
            <td><?php echo CHtml::link(CHtml::encode($model->category->name), array('site/category', 'id'=>$model->category->id)); ?></td>
            <td>
                <?php if ($model->getPhoto()): ?>
                <img src="<?php echo $model->getPhoto()->getPreview(); ?>" width="150" alt="<?php echo CHtml::encode($model->name) ?>" />
                <?php endif; ?>
            </td>
            <td><?php echo CHtml::link(CHtml::encode($model->name), array('site/bulletin', 'id'=>$model->id)); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>