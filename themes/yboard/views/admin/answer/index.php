<?php
/* @var $this AnswerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    Yii::t('lang','Answers'),
);

$this->menu = array(
    array('label' => Yii::t('lang','Create Answer'), 'icon' => 'icon-plus', 'url' => array('create')),
    array('label' => Yii::t('lang','Manage Answer'), 'icon' => 'icon-folder-open', 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('lang','Answers'); ?></h1>

<?php
$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>


<?php 

?>
