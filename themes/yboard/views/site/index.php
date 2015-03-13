<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<?php
if ($this->beginCache('index', array(
            'duration' => 0,
            'dependency' => array(
                'class' => 'system.caching.dependencies.CDbCacheDependency',
                'sql' => 'SELECT last_insert_rowid() FROM bulletin')
        ))) {
    ?>
    <table class="roots">
        <tbody>
            <?php for ($i = 0; $i < count($roots);) : ?>
                <tr>
                    <?php for ($j = 0; $j < 3; $j++): ?>
                        <td>
                            <?php if (array_key_exists($i, $roots)){ 
								$category=$roots[$i++];
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
							<?php }  ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <?php
    $this->endCache();
}
?>
<table class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th colspan="5">
                Топ объявлениий:
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($IndexAdv as $model): ?>
        <tr>
			<td>
                <?php if ($model->getPhoto()): ?>
                <img src="<?php echo $model->getPhoto()->getPreview(); ?>" width="150" alt="<?php echo CHtml::encode($model->name) ?>" />
                <?php endif; ?>
            </td>
            <td><?php echo CHtml::link(CHtml::encode($model->category->name), array('/adverts/category', 'cat_id'=>$model->category->id)); ?></td>
            <td><?php echo CHtml::link(CHtml::encode($model->name), array('/adverts/view', 'id'=>$model->id)); ?></td>
            <td><?php echo Yii::app()->dateFormatter->formatDateTime($model->created_at); ?></td>
			<td><?php echo $model->itemAlias('type', $model->type); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

