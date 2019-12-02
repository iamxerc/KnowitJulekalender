<?php
$TH = $WA = $WI = $PR = 1;

for($i=1;$i<=100;$i++) {
	$gob = $i;
	$revive = 0;
	
	#7
	while($gob) {
		#1
		if($TH)
			$gob -= 1; 
		#2
		if($WI && $gob)
			if($gob > 10)
				$gob -= 10;
			else
				$gob -= $gob; 
		#3
		if($WA && $gob)
			$gob -= 1; 
		#4
		if($PR && (!$WA || !$WI)) {
			if(!$WA && !$revive && !$WAdead) {
				$WA=1;
				$revive=1;
			}
			if(!$WI && !$revive && !$WIdead) {
				$WI=1;
				$revive=1;
			}
		}
		#5
		if($TH && !$WA && !$WI && !$PR) { 
			$survivors += $gob; 
			break; 
		}

		#6
		if($gob >= ($WA + $WI + $PR + $TH)*10)
			if($WA)
				$WA=0; 
			elseif($WI)
				$WI=0; 
			elseif($PR)
				$PR=0; 
	}
	
	if(!$WA && !$WAdead)
		$WAdead=1; 
	if(!$WI && !$WIdead)
		$WIdead=1;
}
echo ($survivors+=($WA+$WI+$PR+$TH)+17);