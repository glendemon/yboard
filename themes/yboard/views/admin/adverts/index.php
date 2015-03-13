<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    Yii::t('lang','Bulletins') => array('index'),
    Yii::t('lang','Manage'),
);

$this->menu = array(
    array('label' => Yii::t('lang','List Bulletin'), 'icon' => 'icon-list', 'url' => array('index'),"itemOptions"=>array('class'=>'btn')),
    array('label' => Yii::t('lang','Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create') ,"itemOptions"=>array('class'=>'btn')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bulletin-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('lang','Manage Bulletins'); ?></h1>

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
    'id' => 'bulletin-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
		array(            // display 'create_time' using an expression
            'class'=>'CLinkColumn',
			'header'=>'name',
			'labelExpression'=>'$data->name',
			'urlExpression'=>'Yii::app()->createUrl("/admin/adverts/view",array("id"=>$data->id))',
        ),
		array(            // display 'create_time' using an expression
            'class'=>'CLinkColumn',
			'header'=>'user_id',
			'labelExpression'=>'$data->user->username',
			'urlExpression'=>'Yii::app()->createUrl("/user/view",array("id"=>$data->id))',
        ),
		array(
			'name'=>'category_id',
			'value'=>'$data->category->name',
		),
        'type',
        'views',
        /*
          'text',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
    ),
));
?>
