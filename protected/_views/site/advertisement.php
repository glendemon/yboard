<?php
/* @var $this SiteController */
/* @var $model Bulletin */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs = array();
$this->breadcrumbs[] = CHtml::encode($model->name);
?>

<table>
    <thead>
        <tr><th colspan="2"><?php echo CHtml::encode($model->name); ?></th></tr>
    </thead>
    <tbody>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('contact')); ?>:</td>
            <td><?php echo CHtml::encode($model->contact); ?></td>
        </tr>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('url')); ?>:</td>
            <td><?php echo CHtml::encode($model->url); ?></td>
        </tr>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</td>
            <td><?php echo CHtml::encode($model->email); ?></td>
        </tr>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('phone')); ?>:</td>
            <td><?php echo CHtml::encode($model->phone); ?></td>
        </tr>
        <?php if ($model->youtube && is_array($model->youtube)): ?>
        <?php foreach($model->youtube as $youtube): ?>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('youtube')); ?>:</td>
            <td><?php $this->widget('ext.Yiitube', array('v' => $youtube, 'size' => 'small')); ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</td>
            <td><?php echo CHtml::encode($model->description); ?></td>
        </tr>
        <tr class="<?php echo Yii::app()->evenness->next(); ?>">
            <td><?php echo CHtml::encode($model->getAttributeLabel('gallery_id')); ?>:</td>
            <td>
                <?php $this->widget('application.widgets.ShowImagesWidget', array('bulletin' => $model)); ?>
            </td>
        </tr>
    </tbody>
</table>