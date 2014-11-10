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
                            <?php if (array_key_exists($i, $roots)): ?>
                                <?php $this->widget('application.widgets.SubcategoryWidget', array('category' => $roots[$i++])); ?>
                            <?php else: ?>
                                &nbsp;
                            <?php endif; ?>
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
<?php
if ($this->beginCache('TopBulletinsWidget', array(
            'duration' => 0,
            'dependency' => array(
                'class' => 'system.caching.dependencies.CDbCacheDependency',
                'sql' => "SELECT value FROM Config WHERE key='top'")
        ))) {
    ?>
    <?php $this->widget('application.widgets.TopBulletinsWidget'); ?>
    <?php
    $this->endCache();
}
?>

