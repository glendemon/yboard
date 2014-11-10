<?php
/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */
/* @var $category Category */
/* @var $subcategory Category */
?>
<table class="table table-hover">
    <tr class="hero-unit">
        <td class="image">
            <?php if ($category->icon): ?>
                <img src="<?php echo Yii::app()->request->baseUrl; ?><?php echo CHtml::encode($category->icon); ?>" />
            <?php endif; ?>
        </td>
        <td>
            <a href="<?php echo Yii::app()->createUrl('site/category', array('id' => $category->id)); ?>">
                <h5> <?php echo CHtml::encode($category->name); ?> </h5>
            </a>
        </td>
        <td>
            <span class="label label-info"><?php echo $category->countBulletins() ? '' . $category->countBulletins() . '' : ''; ?></span> 
        </td>
    </tr>
    <?php foreach ($category->children()->findAll() as $subcategory): ?>
        <tr>
            <td colspan="2">
                <?php if ($subcategory->countBulletins()): ?>
                    <span class="label badge-info">+</span>
                <?php else: ?>
                    <span class="label">x</span>
                <?php endif; ?>
                <a href="<?php echo Yii::app()->createUrl('site/category', array('id' => $subcategory->id)); ?>"><?php echo CHtml::encode($subcategory->name); ?></a>
            </td>
            <td>
                <span class="label label-info"><?php echo $subcategory->countBulletins() ? '' . $subcategory->countBulletins() . '' : ''; ?></span>
            </td>
        </tr>
    <?php endforeach; ?>
</table>