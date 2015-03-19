<?php
/* @var $this SiteController */
/* @var $model Bulletin */

$this->pageTitle = Yii::app()->name;
$this->breadcrumbs = array();
if ($model->category->parent)
    $this->breadcrumbs[$model->category->parent->name] = array('site/category', 'id' => $model->category->parent->id);
$this->breadcrumbs[$model->category->name] = array('site/category', 'id' => $model->category->id);
?>
<div class="well">
    <table class="table">
        <thead>
            <tr><th colspan="2" class="alert-info">
        <?php echo CHtml::encode($model->name); ?>
        <div style='font-size:12px;'>
            <i class='fa fa-user'></i>
                <?php echo CHtml::link(CHtml::encode($model->user->username), 
                        array('user/user/view', 'id' => $model->user->id)); ?>  
            <div id='owner-info' style='display:none'> 

            <?php echo CHtml::link(Yii::t('bulletin', 'Send a mail to the author'), 
            array('site/contact', 'id' => $model->user->id)); ?>

            </div>
            <i class='fa fa-time'></i><i><?php echo Yii::app()->dateFormatter->formatDateTime($model->created_at); ?></i>
            <i class='fa fa-eye'></i><i><?php echo CHtml::encode($model->views); ?>
            <?php echo $model->itemAlias('type', $model->type); ?>
        </div>
        </th></tr>
        </thead>
        <tbody>

            <tr class="">
                <td><?php echo CHtml::encode($model->getAttributeLabel('text')); ?>:</td>
                <td><?php echo CHtml::encode($model->text); ?></td>
            </tr>
            <? if (sizeof($model->fields) > 0 and is_array($model->fields)) { ?>
            <tr class="">
                <td><?php echo CHtml::encode($model->getAttributeLabel('fields')); ?>:</td>
                <td><?php
                if (is_array($model->fields))
                    foreach ($model->fields as $f_name => $field) {

                        echo $f_name . " - " . $field . "<br/>";
                    }
                ?>


                </td>
            </tr>
                    <? } ?>

            <? if ($model->youtube_id !== "") { ?>
                <tr class="">
                    <td><?php echo CHtml::encode($model->getAttributeLabel('youtube_id')); ?>:</td>
                    <td><?php $model->youtube_id ? $this->widget('ext.Yiitube', 
                            array('v' => $model->youtube_id, 'size' => 'small')) : ''; ?></td>
                </tr>
            <? } ?>

            <tr class="">
                <td><?php echo CHtml::encode($model->getAttributeLabel('gallery_id')); ?>:</td>
                <td>
            <?php $this->widget('application.widgets.ShowImagesWidget', array('bulletin' => $model)); ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>