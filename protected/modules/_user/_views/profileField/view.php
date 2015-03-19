<?php
$this->breadcrumbs = array(
    t('Profile Fields') => array('admin'),
    t($model->title),
);
$this->menu = array(
    array('label' => t('Create Profile Field'), 'icon' => 'icon-th-list', 'url' => array('create')),
    array('label' => t('Update Profile Field'), 'icon' => 'icon-refresh', 'url' => array('update', 'id' => $model->id)),
    array('label' => t('Delete Profile Field'), 'icon' => 'icon-remove-sign', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => t('Are you sure to delete this item?'))),
    array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('admin')),
    array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')),
);
?>
<h1><?php echo t('View Profile Field #') . $model->varname; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'varname',
        'title',
        'field_type',
        'field_size',
        'field_size_min',
        'required',
        'match',
        'range',
        'error_message',
        'other_validator',
        'widget',
        'widgetparams',
        'default',
        'position',
        'visible',
    ),
));
?>
