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
			<a href="<?=Yii::app()->createUrl("/site/page")?>" class="general">Правила работы</a> 
	    </div>
	    <div class="works">
			<a href="<?=Yii::app()->createUrl("/site/contacts")?>" class="general">Контакты</a>
		</div>
   </div>
 </div>
</div>
<div id='content'>
<div id="body_area">
	<?php echo $content; ?>
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
