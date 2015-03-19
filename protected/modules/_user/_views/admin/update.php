<?php
$this->breadcrumbs = array(
    (t('Users')) => array('admin'),
    $model->username => array('view', 'id' => $model->id),
    (t('Update')),
);
$this->menu = array(
    array('label' => t('Create User'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => t('View User'), 'icon' => ' icon-eye-open', 'url' => array('view', 'id' => $model->id)),
    array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
    array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('profileField/admin')),
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
);
?>

<h1><?php echo t('Update User') . " " . $model->id; ?></h1>

<?php
echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile));
?>