<?php
$this->breadcrumbs = array(
    t('Users') => array('admin'),
    $model->username,
);


$this->menu = array(
    array('label' => t('Create User'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => t('Update User'), 'icon' => 'icon-refresh', 'url' => array('update', 'id' => $model->id)),
    array('label' => t('Delete User'), 'icon' => 'icon-minus', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => t('Are you sure to delete this item?'))),
    array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
    array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('profileField/admin')),
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
);
?>
<h1><?php echo t('View User') . ' "' . $model->username . '"'; ?></h1>

<?php
$attributes = array(
    'id',
    'username',
);

$profileFields = ProfileField::model()->forOwner()->sort()->findAll();
if ($profileFields) {
    foreach ($profileFields as $field) {
        array_push($attributes, array(
            'label' => t($field->title),
            'name' => $field->varname,
            'type' => 'raw',
            'value' => (($field->widgetView($model->profile)) ? $field->widgetView($model->profile) : (($field->range) ? Profile::range($field->range, $model->profile->getAttribute($field->varname)) : $model->profile->getAttribute($field->varname))),
        ));
    }
}

array_push($attributes, 'password', 'email', 'activkey', 'create_at', 'lastvisit_at', array(
    'name' => 'superuser',
    'value' => User::itemAlias("AdminStatus", $model->superuser),
        ), array(
    'name' => 'status',
    'value' => User::itemAlias("UserStatus", $model->status),
        )
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => $attributes,
));
?>
