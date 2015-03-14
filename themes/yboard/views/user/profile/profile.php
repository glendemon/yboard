<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile"),
);


$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'icon' => 'icon-folder-open', 'url' => array('/user/admin')) : array()),
    array('label' => UserModule::t('List User'), 'icon' => 'icon-list', 'url' => array('/user')),
    array('label' => UserModule::t('Edit'), 'icon' => 'icon-pencil', 'url' => array('edit')),
    array('label' => UserModule::t('Change password'), 'icon' => 'icon-edit', 'url' => array('changepassword')),
    array('label' => UserModule::t('Logout'), 'icon' => ' icon-off', 'url' => array('/user/logout')),
);
?><h1><?php echo UserModule::t('Your profile'); ?></h1>

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
