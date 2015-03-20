<?php if (Yii::app()->user->isGuest): ?>

<div id="uLogin" x-ulogin-params="display=<?php echo $display ?>;fields=<?php echo $fields ?>;optional=<?php echo $optional ?>;providers=<?php echo $providers ?>;hidden=<?php echo $hidden ?>;redirect_uri=<?php echo urlencode($redirect) ?>"></div>

<?php else: ?>
    <?
    $anchor = 'Выйти ('.Yii::app()->user->getName().')';
    echo CHtml::link($anchor, array($logout_url));
    ?>
<?php endif ?>