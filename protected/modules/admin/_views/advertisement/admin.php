<?php
/* @var $this AdvertisementController */
/* @var $model Advertisement */

$this->breadcrumbs = array(
    AdminModule::t('Advertisements') => array('index'),
    AdminModule::t('Manage'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Advertisement'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Create Advertisement'), 'icon' => 'icon-plus', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#advertisement-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo AdminModule::t('Manage Advertisements'); ?></h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'banner',
        'url',
        'name',
        'description',
        'order',
        /*
          'gallery_id',
          'extra',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
    ),
));
?>
