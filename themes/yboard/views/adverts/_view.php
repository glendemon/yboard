<?
/* @var $this BulletinController */
/* @var $data Bulletin */
?>
<div class="well advertList">
    <div style='float:left; width: 95px; height: 60px; overflow:hidden;'>
        <? if ($data->gallery && $data->gallery->galleryPhotos) { ?>
            <?
            $this->widget('application.extensions.fancybox.EFancyBox', array(
                'target' => '.fancybox',
                'config' => array(),
                    )
            );
            ?>
            <? foreach ($data->gallery->galleryPhotos as $model) { ?>
                <a href="<? echo $model->getUrl(); ?>" class="fancybox" rel="<? echo CHtml::encode($data->id) ?>">
                    <img src="<? echo $model->getPreview(); ?>" 
                         style='max-width:95px; max-height:60px;' alt="<? echo CHtml::encode($data->name) ?>" />
                </a>
            <? }
        } else { ?>
            <a href="<?= Yii::app()->createUrl('adverts/view', 
                    array('id' => $data->id)) ?>" class="fancybox" rel="<? echo CHtml::encode($data->id) ?>">
                <img src="<? echo Yii::app()->baseUrl."/gallery/noimage.gif"; ?>" 
                     style='max-width:95px; max-height:60px;' alt="<? echo CHtml::encode($data->name) ?>" />
            </a>
        <? } ?>
    </div>
    <div style='margin-left:100px'>
        <div>
            <? echo CHtml::link(CHtml::encode($data->name), array('adverts/view', 'id' => $data->id)); ?>
            <? if ($data->user_id == Yii::app()->user->id) { ?>
                <a href='<?= Yii::app()->createUrl('adverts/update', array('id' => $data->id)) ?>' class='redact'> редактировать </a>
            <? } ?>
        </div>
        <div><? echo CHtml::encode($data->text); ?></div>
    </div>
    <table class="table" style='display:none'>
        <tr class="alert-info">
            <td><b><? echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>

            </td>
        </tr>
        <tr class="alert-block">
            <td> <b><? echo CHtml::encode($data->getAttributeLabel('gallery_id')); ?>:</b>

            </td>
        </tr>
    </table>
</div>