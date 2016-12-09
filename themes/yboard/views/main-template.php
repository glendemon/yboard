<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php Yii::app()->bootstrap->register(); ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $this->meta_title(); ?></title>
        <meta name="description" content="<?php echo $this->meta_description(); ?>" />

        <script> baseUrl = '<?= Yii::app()->baseUrl ?>';</script>


        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js_plugins/yboard.js" ></script>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main_style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link id="page_favicon" href="favicon.png" rel="icon" type="image/x-icon" />

    </head>

    <body>

        <?
        //echo CHtml::link("Ожидает", array("/admin/adverts/update", "id" => $data->id ), array("target"=>"_blank")  );
        ?>

        <div id='header'>
            <div id="topheader">
                <a href='<?= Yii::app()->createUrl("/") ?>' class="logo">Доска объявлений на Yii</a>
                <div class="menu_area">
                    <div class='ideas'>
                        <a href="<?= Yii::app()->createUrl("/adverts") ?>" class="general">Объявления</a> 
                        <a href='<?= Yii::app()->createUrl("/adverts/create") ?>' class="menu_text">
                            <i class='fa fa-plus'></i>добавить
                        </a>
                    </div>
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('url' => Yii::app()->createUrl("login"),
                                'label' => "<i class='fa fa-sign-in'></i>" . t("Login"),
                                'visible' => Yii::app()->user->isGuest
                            ),
                            array('url' => Yii::app()->createUrl("registration"),
                                'label' => "<i class='fa fa-user-plus'></i>" . t("Register"),
                                'visible' => Yii::app()->user->isGuest
                            ),
                            array('url' => Yii::app()->createUrl('user/' . Yii::app()->user->id),
                                'label' => "<i class='fa fa-user'></i>" . t("Profile"),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array('url' => Yii::app()->createUrl('adverts/user', array('id' => Yii::app()->user->id)),
                                'label' => "<i class='fa fa-bullhorn'></i>" . t("My adverts"),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array('url' => Yii::app()->createUrl('adverts/favorites'),
                                'label' => "<i class='fa fa-bookmark-o'></i>" . t("Favorites advert"),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array('url' => Yii::app()->createUrl("messages"),
                                'label' => "<i class='fa fa-comment-o'></i>" . t("Messages"),
                                'visible' => !Yii::app()->user->isGuest
                            ),
                            array('url' => Yii::app()->createUrl('logout'),
                                'label' => "<i class='fa fa-sign-out'></i>" . t("Logout") . ' (' . Yii::app()->user->username . ')',
                                'visible' => !Yii::app()->user->isGuest
                            ),
                        ),
                        'encodeLabel' => false,
                    ));
                    ?>  


                </div>
            </div>
        </div>
        <div id='content'>
            <div id="body_area">
                <div class="left">
                    <div class="left_menu_area">
                        <div align="right">
                            <?php
                            $catTreeGenerator = new Category();
                            $catTreeGenerator->menuItems(0);

                            $this->widget('zii.widgets.CMenu', array(
                                'items' => $catTreeGenerator->menuItems(intval($_GET['cat_id'])),
                                'htmlOptions' => array('class' => 'nav sidebar-menu'),
                                'encodeLabel' => FALSE,
                                'submenuHtmlOptions' => array('class' => 'submenu'),
                                    )
                            );
                            ?>
                        </div>
                    </div>



                    <?= $this->getBanner('right_adv') ?>
                    <div class='articleList'> 
                        <? $this->widget('application.widgets.articleList'); ?>
                    </div>


                </div>
                <div class="midarea">
                    <form name='search_form' class='searchForm' action='<?= Yii::app()->createUrl('/adverts/search') ?>'>
                        <input type='text' name='searchStr'  
                               value='<?= Yii::app()->request->getParam("searchStr") ?>' />
                        <input type='submit' value='Поиск' class='btn' /> <br/>
                        <a href="javascript:void(0)" onclick="open_search()" ><?= t("Advanced search") ?></a>
                        
                        
                        <div class='advanced_search' <? echo is_array(Yii::app()->request->getParam("Adverts"))?"":"style='display:none'"?> >
                            <? $this->widget('application.widgets.advancedSearch'); ?>
                        </div>
                    </form>
                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif; ?>



                    <?php echo $content; ?>

                </div>
                <br style='clear:both' />
            </div>
        </div>

        <div id="fotter">
            <div class="fotter_copyrights">
                <div align="center"> © Copyright Information Goes Here. All Rights Reserved  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <a href="http://validator.w3.org/check?uri=referer" target="_blank" class="xhtml">XHTML</a> <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="css">CSS</a>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

                    Developed By : <a href="http://vencendor.ru" class="fotter_designedlink">Vencendor</a> 


                </div>
            </div>

        </div>


    </body>
</html>
