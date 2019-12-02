<?php
$x=0;
for($i=6;;$i++) {
	$num = str_split($i);
	$last = array_pop($num);
	if($last != 6)
		continue;
	array_unshift($num,6);
	if(implode($num) == $i*4) {
		echo $i;
		die;
	}
}
?>