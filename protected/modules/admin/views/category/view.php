<!--
/**
 * Details view  for JsTreeBehavior model.
 *
 * Date: 1/29/13
 * Time: 12:00 PM
 *
 * @author: Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://iws.kabasakalis.gr/
 * @link http://www.reverbnation.com/spiroskabasakalis
 * @copyright Copyright &copy; Spiros Kabasakalis 2013
 * @license http://opensource.org/licenses/MIT  The MIT License (MIT)
 */
-->
<?php
$this->breadcrumbs = array(
    AdminModule::t('Categories') => array('index'),
    $model->name => array('view', 'id' => $model->id),
    AdminModule::t('View'),
);

$this->menu = array(
    array('label' => AdminModule::t('List Category'), 'icon' => 'icon-list', 'url' => array('index')),
    array('label' => AdminModule::t('Manage Category'), 'icon' => 'icon-folder-open', 'url' => array('admin'))
);
?>


<div class="page-header">
    <h1><?php echo $model->name; ?>    </h1>
    <h2><?php echo Yii::t('global', 'Details') ?></h2>




    <?php
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'data' => $model,
        'htmlOptions' => array('class' => 'table table-striped table-bordered table-condensed'),
        //modify attributes according to your model
        'attributes' => array(
            'id',
            'root',
            'lft',
            'rgt',
            'level',
            'name',
            'icon',
        ),
    ));
    ?>
</div>

