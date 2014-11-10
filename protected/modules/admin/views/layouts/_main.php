<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl . '/css/main.css'); ?>
        <?php Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl . '/css/form.css'); ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>


        <div id="mainmenu">
            <?php
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'type' => 'null',
                'brand' => 'YiiBoard',
                'brandUrl' => '/',
                'collapse' => true,
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => array(
                            array('label' => 'Главная страница', 'url' => array('/site/index')),
                            array('label' => 'Добавить объявление', 'url' => array('/site/create')),
                            array('label' => 'Правила работы', 'url' => array('/site/page', 'view' => 'about')),
                            array('label' => Yii::t('main', 'Answers'), 'url' => array('/answer/index')),
                            array('label' => 'Обратная связь', 'url' => array('/site/contact')),
                            array('url' => Yii::app()->getModule('user')->loginUrl, 'label' => Yii::app()->getModule('user')->t("Login"), 'visible' => Yii::app()->user->isGuest),
                            array('url' => Yii::app()->getModule('user')->registrationUrl, 'label' => Yii::app()->getModule('user')->t("Register"), 'visible' => Yii::app()->user->isGuest),
                            array('url' => Yii::app()->getModule('user')->profileUrl, 'label' => Yii::app()->getModule('user')->t("Profile"), 'visible' => !Yii::app()->user->isGuest),
                            array('url' => Yii::app()->getModule('user')->logoutUrl, 'label' => Yii::app()->getModule('user')->t("Logout") . ' (' . Yii::app()->user->name . ')', 'visible' => !Yii::app()->user->isGuest),
                        ),
                    )),
            ));
            ?>

        </div><!-- mainmenu -->

        <div id="wrap">
            <?php
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
                'stacked' => false, // whether this is a stacked menu
                'items' => array(
                    array('label' => AdminModule::t('Categories'), 'url' => array('category/index'),),
                    array('label' => AdminModule::t('Bulletins'), 'url' => array('bulletin/index')),
                    array('label' => AdminModule::t('Users'), 'url' => array('/user/user/index')),
                    array('label' => AdminModule::t('Advertisements'), 'url' => array('advertisement/index')),
                    array('label' => AdminModule::t('Answers'), 'url' => array('answer/index')),
                    array('label' => AdminModule::t('Config'), 'url' => array('default/config')),
                ),
            ));
            ?>
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif; ?>

            <?php echo $content; ?>
        </div>

        <div class="clear"></div>

        <div class="well" align="center">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </div><!-- footer -->

        <!-- counters -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-XXXXX-X']);
            _gaq.push(['_trackPageview']);
            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

    </body>
</html>
