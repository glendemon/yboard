<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $bulletin Bulletin */
/* @var $model GalleryPhoto */
?>

<?php if ($bulletin->gallery && $bulletin->gallery->galleryPhotos): ?>
    <?php
    $this->widget('application.extensions.fancybox.EFancyBox', array(
        'target' => '.fancybox',
        'config' => array(),
        )
    );
    ?>
    <?php foreach($bulletin->gallery->galleryPhotos as $model): ?>
        <a href="<?php echo $model->getUrl(); ?>" class="fancybox" rel="<?php echo CHtml::encode($bulletin->id) ?>">
            <img src="<?php echo $model->getPreview(); ?>" width="150" alt="<?php echo CHtml::encode($bulletin->name) ?>" />
        </a>
    <?php endforeach; ?>
<?php endif; ?>
