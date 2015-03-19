<?php
$this->breadcrumbs = array(
    t('Users') => array('admin'),
    t('Create'),
);

$this->menu = array(
    array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
    array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('profileField/admin')),
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
);
?>
<h1><?php echo t("Create User"); ?></h1>

<?php
echo $this->renderPartial('_form', array('model' => $model, 'profile' => $profile));
?>