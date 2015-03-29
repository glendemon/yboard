<?php
$this->breadcrumbs=array(
	'Install Site Structure mosule',
);
?>
<h1>Install Site Structure module</h1>

<p>
    <?php 
        if (!$installed) 
            echo CHtml::link('Install database',array('install/installDatabase'));
        else
            echo 'Module table <b>'.$this->tableName.'</b> already exists'; 
    ?>
</p>

<p><?php if ($result) echo $result; ?></p>