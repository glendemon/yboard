<?php
$this->breadcrumbs = array(
    t('Profile Fields') => array('admin'),
    t('Create'),
);
$this->menu = array(
    array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('admin')),
    array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')),
);
?>
<h1><?php echo t('Create Profile Field'); ?></h1>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>