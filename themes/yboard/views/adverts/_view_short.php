<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<? $model= $data->gallery->galleryPhotos[0]; ?>
<a href="<?= Yii::app()->createUrl('adverts/view', 
                    array('id' => $data->id)) ?>" class="fancybox" rel="<? echo CHtml::encode($data->id) ?>">
<img src="<? echo $model->getPreview(); ?>" 
                         style='max-width:95px; max-height:60px;' alt="<? echo CHtml::encode($data->name) ?>" />
</a>