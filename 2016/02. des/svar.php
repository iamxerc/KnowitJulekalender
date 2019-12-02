<?php
$last=0;
$curr=1;
while(($next = $last + $curr) < 4000000000) {
	if(is_int($next/2))
		$sum += $next;
	$last = $curr;
	$curr = $next;
}
echo $sum;
?>