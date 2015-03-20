<?php
$this->breadcrumbs=array(
	t('Users')=>array('index'),
	$model->username,
);
$this->layout='//main-template';
$this->menu=array(
    array('label'=>t('List User'), 'icon'=>'icon-list', 'url'=>array('index')),
);
?>
<h3><?php echo t('View User').' "'.$model->username.'"'; ?></h3>
<?php 

// For all users
	$attributes = array(
			'username',
	);
	
	/*
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => t($field->title),
					'name' => $field->varname,
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),

				));
		}
	}
	 * 
	 */
	array_push($attributes,
		'create_at',
		array(
			'name' => 'lastvisit_at',
			'value' => (($model->lastvisit_at!='0000-00-00 00:00:00')?$model->lastvisit_at:t('Not visited')),
		)
	);
			
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));

?>


<a class='send_mail btn' style='margin:5px auto 0px' href='<?=Yii::app()->createUrl('messages/create',array('id'=>$model->id))?>'> Отправить сообщение </a>
