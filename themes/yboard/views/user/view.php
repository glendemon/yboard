<?php
$this->breadcrumbs = array(
    t('Users') => array('index'),
    $model->username,
);
$this->layout = '//main-template';
$this->menu = array(
    array('label' => t('List User'), 'icon' => 'icon-list', 'url' => array('index')),
);
?>

<?php
// For all users
$attributes = array(
    'username',
    'full_name',
    'email',
    'birthday',
    'location',
    'phone',
    'skype',
    'contacts',
    'lastvisit_at',
    'create_at',
        //'value' => (($model->lastvisit_at != '0000-00-00 00:00:00') ? $model->lastvisit_at : t('Not visited')),
);

/*
  array_push($attributes, 'create_at', array(

  )
  );
 * 
 */
?>
<div class='userHead'>
    <h4><? echo $model->username; ?></h4> <? if ($model->lastvisit_at) { 
        echo "(".PeopleDate::format($model->lastvisit_at) .")"; 
    } ?>
    <? if (Yii::app()->user->id == Yii::app()->request->getParam("id")) { ?>
        <a href='<? echo Yii::app()->createUrl('user/update', array('id' => $model->id)) ?>'> Редактировать </a>
    <? } ?>
    <? if (Yii::app()->user->isAdmin() and Yii::app()->user->id != $model->id ) { ?>
        <a href='<? echo Yii::app()->createUrl('user/ban', array('id' => $model->id)) ?>'> Заблокировать </a>
    <? } ?>
    <div> 
        <a href='<? echo Yii::app()->createUrl("adverts/user", array('id' => $model->id)) ?>'> <?= t('Adverts') ?> </a> 
        | <a href='<? echo Yii::app()->createUrl("user/view", array('id' => $model->id)) ?>'> <?= t('Personal dates') ?> </a> 
    </div>
</div>
<div> 
    <dl>
        <? if ($model->full_name) { ?>
            <dt><?= t('Полное имя') ?> :</dt> <dd> <?= $model->full_name ?> </dd>
        <? } if ($model->birthday and $model->birthday !== "0000-00-00") { ?>
            <dt><?= t('Дата рождения') ?> :</dt> <dd> <?= PeopleDate::format($model->birthday) ?> </dd>
        <? } if ($model->location) { ?>
            <dt><?= t('Место проживания') ?> :</dt> <dd> <?= $model->location ?> </dd>
        <? } ?>
        <br/>
        <h4><?= t('Контакты') ?> : </h4>
        <? if ($model->phone) { ?>
            <dt><?= t('Телефон') ?> :</dt> <dd> <?= $model->phone ?> </dd>
        <? } if ($model->skype) { ?>
            <dt><?= t('Skype') ?> :</dt> <dd> <?= $model->skype ?> </dd>
        <? } if ($model->email) { ?>
            <dt><?= t('Почта') ?> :</dt> <dd> <?= $model->email ?> </dd>
        <? } if ($model->contacts) { ?>


            <dt><?= t('Другие контакты') ?> :</dt> <dd> <?= $model->contacts ?> </dd>
        <? } if ($model->create_at) { ?>
            <dt><?= t('Дата регистрации') ?> :</dt> <dd> <?= PeopleDate::format($model->create_at) ?> </dd>
        <? } ?>

    </dl>
    <?
    if (Yii::app()->user->id !== $model->id) {
        echo $this->renderPartial('/messages/_form', array('model' => $mes_model, 'receiver' => $model->id));
    }
    ?>
</div>
