<?php
$this->pageTitle = Yii::app()->name . ' - ' . t("Profile");
$this->breadcrumbs = array(
    t("Profile"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')) : array()),
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
    array('label' => t('Edit'), 'icon' => 'icon-pencil', 'url' => array('edit')),
    array('label' => t('Change password'), 'icon' => 'icon-edit', 'url' => array('changepassword')),
    array('label' => t('Logout'), 'icon' => ' icon-off', 'url' => array('/user/logout')),
);
?><h1><?php echo t('Your profile'); ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<table class="dataGrid">
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
        <td><?php echo CHtml::encode($model->username); ?></td>
    </tr>
    <?php
    $profileFields = ProfileField::model()->forOwner()->sort()->findAll();
    if ($profileFields) {
        foreach ($profileFields as $field) {
            //echo "<pre>"; print_r($profile); die();
            ?>
            <tr>
                <th class="label"><?php echo CHtml::encode(t($field->title)); ?></th>
                <td><?php echo (($field->widgetView($profile)) ? $field->widgetView($profile) : CHtml::encode((($field->range) ? Profile::range($field->range, $profile->getAttribute($field->varname)) : $profile->getAttribute($field->varname)))); ?></td>
            </tr>
            <?php
        }//$profile->getAttribute($field->varname)
    }
    ?>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
        <td><?php echo CHtml::encode($model->email); ?></td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
        <td><?php echo $model->create_at; ?></td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
        <td><?php echo $model->lastvisit_at; ?></td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
        <td><?php echo CHtml::encode(User::itemAlias("UserStatus", $model->status)); ?></td>
    </tr>
</table>
