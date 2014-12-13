<?php
/* @var $this SiteController */
/* @var $model Bulletin */

$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array();
if ($model->category->parent)
    $this->breadcrumbs[$model->category->parent->name] = array('site/category', 'id' => $model->category->parent->id);
$this->breadcrumbs[$model->category->name] = array('site/category', 'id' => $model->category->id);
$this->breadcrumbs[] = CHtml::encode($model->name);


var_dump($model->fields);
var_dump($model->category->fields);

?>
<div class="well">
    <table class="table">
        <thead>
            <tr><th colspan="2" class="alert-info"><?php echo CHtml::encode($model->name); ?></th></tr>
        </thead>
        <tbody>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td class="labels"><?php echo CHtml::encode($model->getAttributeLabel('type')); ?>:</td>
                <td><?php echo $model->itemAlias('type', $model->type); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:</td>
                <td><?php echo Yii::app()->dateFormatter->formatDateTime($model->created_at); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->getAttributeLabel('views')); ?>:</td>
                <td><?php echo CHtml::encode($model->views); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->user->profile->getAttributeLabel('company')); ?>:</td>
                <td><?php echo CHtml::encode($model->user->profile->company); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->user->getAttributeLabel('username')); ?>:</td>
                <td><?php echo CHtml::link(CHtml::encode($model->user->username), array('user/user/view', 'id' => $model->user->id)); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->user->getAttributeLabel('email')); ?>:</td>
                <td>
                    <?php echo CHtml::link(Yii::t('bulletin', 'Send a mail to the author'), array('site/contact', 'id' => $model->user->id)); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->user->profile->getAttributeLabel('city')); ?>:</td>
                <td><?php echo CHtml::encode($model->user->profile->city); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->user->profile->getAttributeLabel('url')); ?>:</td>
                <td><?php echo CHtml::encode($model->user->profile->url); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->user->profile->getAttributeLabel('phone')); ?>:</td>
                <td><?php echo CHtml::encode($model->user->profile->phone); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->getAttributeLabel('youtube_id')); ?>:</td>
                <td><?php $model->youtube_id ? $this->widget('ext.Yiitube', array('v' => $model->youtube_id, 'size' => 'small')) : ''; ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->getAttributeLabel('text')); ?>:</td>
                <td><?php echo CHtml::encode($model->text); ?></td>
            </tr>
            <tr class="<?php echo Yii::app()->evenness->next(); ?>">
                <td><?php echo CHtml::encode($model->getAttributeLabel('gallery_id')); ?>:</td>
                <td>
                    <?php $this->widget('application.widgets.ShowImagesWidget', array('bulletin' => $model)); ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>