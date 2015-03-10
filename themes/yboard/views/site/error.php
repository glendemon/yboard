<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
    'links' => array('', 'Error'),
));
?>
<div>   
    <div class="alert alert-error">
        <h3>Error <?php echo $code; ?></h3>   
        <?php echo CHtml::encode($message); ?>
    </div>    
</div>


