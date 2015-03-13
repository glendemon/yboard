<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <?php Yii::app()->bootstrap->register(); ?>
        <?php Yii::app()->clientScript->registerCSSFile(Yii::app()->theme->baseUrl . '/css/style.css'); ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>


        <div id="mainmenu">
            <?php
            $this->widget('bootstrap.widgets.TbNavbar', array(
                'type' => 'null',
                'brand' => 'YBoard',
                'brandUrl' => Yii::app()->request->baseUrl,
                'collapse' => true,
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => array(
                            array('label' => 'Объявления', 'url' => array('/adverts')),
							array('label' => '+', 'url' => array('/bulletin/create')),
							array('label' => 'Организации', 'url' => array('/profile')),
							array('label' => '+', 'url' => array('/profile/create')),
							array('label' => 'Отзывы', 'url' => array('/reviews')),
							array('label' => '+', 'url' => array('/reviews/create')),
                            array('label' => 'Правила работы', 'url' => array('/site/page', 'view' => 'about')),
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
		<div id='search_form' align='center'><form name='search_form' action='<?=Yii::app()->createUrl('/site/search')?>'><input type='text' name='searchStr' /><input type='submit' value='Поиск' class='btn' /></form></div>
        <div id="wrap">
			<div class='sidebar'>
				<?php
            $this->widget('zii.widgets.CMenu', 
                    array(
                        'items' => Category::menuItems(intval($_GET['cat_id'])),
                        'htmlOptions' => array('class'=>'nav sidebar-menu'),
                        'encodeLabel' => FALSE,
                        'submenuHtmlOptions'=>array('class'=>'submenu'),
                    )
            );
            ?>
			</div>
			<div class='rightbar'>
				<?=$this->getBanner('right')?>
			</div>
			<div class='content'>
				<?php if (isset($this->breadcrumbs)): ?>
					<?php
					$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
						'links' => $this->breadcrumbs,
					));
					?><!-- breadcrumbs -->
				<?php endif; ?>

				<?php echo $content; ?>
			</div>
			
        </div>

        <div class="clear"></div>

        <div class="well" align="center">
            Yboard &copy; by Yumza.  <?php echo Yii::powered(); ?> 
        </div><!-- footer -->



    </body>
</html>
