<?php 
	$this->breadcrumbs = $page->breadcrumbs;
?>
<div style="background-color:#DDD">
    
    <i>section: <?php echo __FILE__; ?></i>
    <h1><?php echo $page->name;?></h1>

    <p><?php echo $content; ?></p>
    
    <p><?php echo $page->content; ?></p>

</div>