<?php
$this->breadcrumbs=array_merge(array(
	'Cms'=>array('cms/admin')), 
    $page->adminBreadcrumbs
);

$this->menu=array(
    array('label'=>t('Add Page'), 'url'=>array('create','type'=>Cms::PAGE,'parent_id'=>$_GET['parent_id'])),
    array('label'=>t('Add Set of Pages'), 'url'=>array('create','type'=>Cms::PAGESET,'parent_id'=>$_GET['parent_id'])),
	array('label'=>t('Add Link'), 'url'=>array('create','type'=>Cms::LINK,'parent_id'=>$_GET['parent_id'])),
    array('label'=>t('View').$page->name,'url'=>array('view','id'=>$page->id)),
    array('label'=>t('Update')." ".$page->name,'url'=>array('update','id'=>$page->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cms-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1 style="margin-bottom:0;"><?php echo $page->name ?></h1>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cms-grid',
	'dataProvider'=>$model->search(@$_GET['parent_id']?$_GET['parent_id']:1),
	'filter'=>$model,
    //'enableSorting'=>false,
    //'showTableOnEmpty'=>false,
    'selectableRows'=>false,
    'emptyText'=>'No pages found.',
    //'filterPosition'=>'footer',
	'columns'=>array(
		array(
            'name'=>'name',
            'type'=>'raw',
            'value'=>'
                $data->image." ".
                (($data->type==Cms::PAGESET)
                ? " ".CHtml::link($data->name,array("cms/admin","parent_id"=>$data->id))
                : $data->name)."<input type=hidden name=Cms[sort][] value={$data->id}>"',
        ),
        array(
            'name'=>'url',
            'type'=>'raw',
            'value'=>'CHtml::link($data->url,$data->type!=Cms::LINK?array("/".$data->url):$data->url,array("target"=>"_blank","style"=>"color:#666;font-size:11px;","title"=>"View page"))',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));

$this->publishJs();
$this->initSort();

?>