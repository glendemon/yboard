<?php $this->beginContent('//layouts/main_cms'); ?>
<div class="container">
    <div class="span-19">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span-5 last">
        <div id="sidebar">
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Site tree',
            ));
            $this->widget('application.modules.cms.components.TreeMenu',array(
                'showRoot'=>false,
                //'tpl'=>'application.views.cms.menu.menu',
            ));
            $this->endWidget();
        ?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>