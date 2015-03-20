<?php
$this->breadcrumbs = array(
    t("Users"),
);
if (UserModule::isAdmin()) {
    $this->layout = '//main-template';
    $this->menu = array(
        array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')),
        array('label' => t('Manage Profile Field'), 'icon' => 'icon-list-alt', 'url' => array('profileField/admin')),
    );
}
?>

<h1><?php echo t("List User"); ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'username',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->username),array("user/view","id"=>$data->id))',
        ),
        'create_at',
        'lastvisit_at',
    ),
));
?>
