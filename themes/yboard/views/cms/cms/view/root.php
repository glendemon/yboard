<?php
$isLink = $model->type==Cms::LINK;
$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'name',
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