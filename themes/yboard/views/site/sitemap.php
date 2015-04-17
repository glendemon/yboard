<?php

foreach( $list as $row ):

echo CHtml::link( $row['loc'], $row['loc']);
echo CHtml::tag('br');

endforeach;

?>
