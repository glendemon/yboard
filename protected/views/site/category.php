<?php
/* @var $this SiteController */
/* @var $model Category */

$this->pageTitle=Yii::app()->name;
$this->breadcrumbs = array();
if ($model->parent)
    $this->breadcrumbs[$model->parent->name] = array('site/category', 'id' => $model->parent->id);
$this->breadcrumbs[] = CHtml::encode($model->name);
?>

<?php if ($model->children()->count()): ?>
    <?php $this->widget('application.widgets.SubcategoryWidget', array('category' => $model)); ?>
<?php else: ?>
<div class="btn btn-block disabled"> <h4><?php echo CHtml::encode($model->name); ?></h4></div>
  

    <?php $this->widget('bootstrap.widgets.TbListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    )); ?>
<?php endif; ?>
