<?php
/* @var $this BulletinController */
/* @var $model Bulletin */

$this->breadcrumbs = array(
    Yii::t('lang', 'Bulletins') => array('index'),
    Yii::t('lang', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('lang', 'List Bulletin'), 'icon' => 'icon-list', 'url' => array('index'), "itemOptions" => array('class' => 'btn')),
    array('label' => Yii::t('lang', 'Create Bulletin'), 'icon' => 'icon-plus', 'url' => array('create'), "itemOptions" => array('class' => 'btn')),
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




<h1><?php echo t('Manage Bulletins'); ?></h1>



<?php echo CHtml::link(t('Advanced Search'), '#', array('class' => 'search-button')); ?>
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
        array(// display 'create_time' using an expression
            'class' => 'CLinkColumn',
            'header' => t('name'),
            'labelExpression' => '$data->name',
            'urlExpression' => 'Yii::app()->createUrl("/admin/adverts/view",array("id"=>$data->id))',
        ),
        array(// display 'create_time' using an expression
            'class' => 'CLinkColumn',
            'header' => t('user_id'),
            'labelExpression' => '$data->user->username',
            'urlExpression' => 'Yii::app()->createUrl("/user/view",array("id"=>$data->id))',
        ),
        array(
            'class' => 'CLinkColumn',
            'header' => t('moderated'),
            'labelExpression' => '$data->moderated?"Отмодереровано":"Ожидает"',
            'urlExpression' => 'Yii::app()->createUrl("/admin/moderate/".$data->id)',
            'linkHtmlOptions' => array(
                'class' => 'moder',
            )
        ),
        array(
            'name' => 'category_id',
            'value' => '$data->category->name',
        ),
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


<script>

    $('a.moder').click(function (e) {
        e.preventDefault();
        $.get($(this).attr('href').toString(), function (data) {
                if(data == "ok")
            }
        $(this).parent().html("Отмодереровано");
        );
    });

</script>

