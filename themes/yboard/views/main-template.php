<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main_style.css" rel="stylesheet" type="text/css" />
<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>
<div id='header'>
 <div id="topheader">
   <a href='<?php echo Yii::app()->baseUrl; ?>' class="logo"></a>
   <div class="menu_area">
		<div class='ideas'>
			<a href="<?=Yii::app()->createUrl("/adverts")?>" class="general">Объявления</a> 
			<a href='<?=Yii::app()->createUrl("/adverts/create")?>' class="menu_text"><i class='fa fa-plus'></i>добавить</a>
		</div>
	    <div class='links'>
			<a href="<?=Yii::app()->createUrl("/user")?>" class="general">Пользователи</a>
	    </div>
	    <div class='info'>
			<a href="<?=Yii::app()->createUrl("/site/about")?>" class="general">Правила работы</a> 
	    </div>
	    <div class="works">
			<a href="<?=Yii::app()->createUrl("/site/contact")?>" class="general">Контакты</a>
		</div>
   </div>
 </div>
</div>
 <div id="search_strip">
<form name='search_form' action='<?=Yii::app()->createUrl('/adverts/search')?>'>
		<input type='text' name='searchStr' style='width:678px;' /><input type='submit' value='Поиск' class='btn' />
</form>
 </div>
<div id='content'>
<div id="body_area">
  <div class="left">
    <div class="left_menu_area">
		Категории
      <div align="right">
		  	<?php
                        
                        $catTreeGenerator=new Category();
                        $catTreeGenerator->menuItems(0);
                        
            $this->widget('zii.widgets.CMenu', 
                    array(
                        'items' => $catTreeGenerator->menuItems(intval($_GET['cat_id'])),
                        'htmlOptions' => array('class'=>'nav sidebar-menu'),
                        'encodeLabel' => FALSE,
                        'submenuHtmlOptions'=>array('class'=>'submenu'),
                    )
            );

            ?>
	  </div>
    </div>
  </div>
  <div class="midarea">
	 <?php if (isset($this->breadcrumbs)): ?>
					<?php
					$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
						'links' => $this->breadcrumbs,
					));
					?><!-- breadcrumbs -->
				<?php endif; ?>
                                        


				<?php echo $content; ?>

  </div>
  <div class="right">
	<div>
	  <?php
          
            $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    array('url' => Yii::app()->createUrl("login"), 
                        'label' => t("Login"), 
                        'visible' => Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->createUrl("registration"), 
                        'label' => t("Register"), 
                        'visible' => Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->createUrl('user/'.Yii::app()->user->id), 
                        'label' => t("Profile"), 
                        'visible' => !Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->createUrl('adverts/user', array('id'=>Yii::app()->user->id)), 
                        'label' => t("Мои объявления"), 
                        'visible' => !Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->createUrl("messages"), 
                        'label' => t("Messages"), 
                        'visible' => !Yii::app()->user->isGuest
                    ),
                    array('url' => Yii::app()->createUrl('logout'), 
                        'label' => t("Logout") . ' (' . Yii::app()->user->username . ')', 
                        'visible' => !Yii::app()->user->isGuest
                    ),
                ),
            ));
		  ?>  
	</div>
	<?=$this->getBanner('right')?>

  </div>
	<br style='clear:both' />
</div>
</div>
<div id="fotter">
  <div class="fotter_links">
    <div align="center"><a href="#" class="fotterlink">Home</a>  |  <a href="#" class="fotterlink">About Us</a>  |  <a href="#" class="fotterlink">Companies Success</a>  |  <a href="#" class="fotterlink">Client Testimonials</a>  |  <a href="#" class="fotterlink">Methods of Development</a>  |  <a href="#" class="fotterlink">Newsletter</a>  |  <a href="#" class="fotterlink">Subscribe Info</a>  |  <a href="#" class="fotterlink">Oppotunities</a>  |  <a href="#" class="fotterlink">Current Events</a>  |  <a href="#" class="fotterlink">Contact Us</a></div>
  </div>
  <div class="fotter_copyrights">
    <div align="center">&copy; Copyright Information Goes Here. All Rights Reserved</div>
  </div>
  <div class="fotter_validation">
    <div align="center"><a href="http://validator.w3.org/check?uri=referer" target="_blank" class="xhtml">XHTML</a> <a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" class="css">CSS</a><br />
    </div>
  </div>
  <div class="fotter_designed">
    <div align="center">Designed By : <a href="#" class="fotter_designedlink">Template World</a></div>
  </div>
</div>


</body>
</html>
