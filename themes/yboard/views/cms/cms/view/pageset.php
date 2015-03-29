<?php
$isLink = $model->type==Cms::LINK;
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'name'=>'Link',
            'type'=>'raw',
            'value'=>CHtml::link($model->url, 
                        !$isLink ? array("/".$model->url) : $model->url,
                        array(
                            'target'=>'_blank',
                            'style'=>"color:#666;font-size:11px;",
                            'title'=>'View on site',
                            )
                        ),
        ),
        'name',
        'overview_page:boolean',
        'content:html',
        array(
            'name'=>'Page access',
            'value'=>$model->accessLevel,
        ),
        'title',
        'keywords',
        'description',
        'layout',
        'section',
        'subsection',
    ),
)); ?>