<?php
for($i=0;$i<=999999;$i++) {
	$tall = str_split($i);
	if(array_sum($tall) == 43) {
		if(!strpos(sqrt($i),'.'))
			$ding++;
		if(!strpos(pow($i,1/3),'.'))
			$ding++;
		if($i <= 500000)
			$ding++;
		if($ding >= 2)
			$sum[] = $i;
	}
	$ding=0;
}
print_r($sum);