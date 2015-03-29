<?php
$isLink = $model->type==Cms::LINK;
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'name'=>'Link label',
            'value'=>$model->name,
        ),
        array(
            'name'=>'Url',
            'type'=>'raw',
            'value'=>CHtml::link($model->url, 
                        !$isLink ? array("/".$model->url) : $model->url,
                        array(
                            'target'=>'_blank',
                            'style'=>"color:#666;font-size:11px;",
                            'title'=>'Follow link',
                            )
                        ),
        ),
    ),
)); ?>