<?php
/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $model Advertisement */
?>
<?php foreach ($data as $model): ?>
    <?php if ($model->url): ?>
        <a href="<?php echo $model->description ? Yii::app()->createUrl('site/advertisement', array('id' => $model->id)) : $model->url; ?>">
    <?php endif; ?>
            <img src="<?php echo $model->getBannerUrl(); ?>" alt="<?php echo $model->name; ?>" />
    <?php if ($model->url): ?>
        </a>
    <?php endif; ?>
<?php endforeach; ?>
