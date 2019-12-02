<?php 
function getClosest($search, $arr) {
	$closest = null;
	foreach($arr as $item) {
		if ($closest === null || abs($search - $closest) > abs($item - $search)) {
			$closest = $item;
		}
	}
	return $closest;
}

function flyttSpringer($rute) {
	#current:
	$current = $rute['x'] + $rute['y'];
	#opp lav venstre:
	$alt["olv"]["x"] = ($rute['x'] - 2);
	$alt["olv"]["y"] = ($rute['y'] + 1);
	$sum["olv"] = $alt["olv"]["x"] + $alt["olv"]["y"];
	#opp høy venstre:
	$alt["ohv"]["x"] = ($rute['x'] - 1);
	$alt["ohv"]["y"] = ($rute['y'] + 2);
	$sum["ohv"] = $alt["ohv"]["x"] + $alt["ohv"]["y"];
	#opp høy høyre:
	$alt["ohh"]["x"] = ($rute['x'] + 1);
	$alt["ohh"]["y"] = ($rute['y'] + 2);
	$sum["ohh"] = $alt["ohh"]["x"] + $alt["ohh"]["y"];
	#opp lav høyre:
	$alt["olh"]["x"] = ($rute['x'] + 2);
	$alt["olh"]["y"] = ($rute['y'] + 1);
	$sum["olh"] = $alt["olh"]["x"] + $alt["olh"]["y"];
	#ned høy venstre:
	$alt["nhv"]["x"] = ($rute['x'] - 2);
	$alt["nhv"]["y"] = ($rute['y'] - 1);
	$sum["nhv"] = $alt["nhv"]["x"] + $alt["nhv"]["y"];
	#ned lav venstre:
	$alt["nlv"]["x"] = ($rute['x'] - 1);
	$alt["nlv"]["y"] = ($rute['y'] - 2);
	$sum["nlv"] = $alt["nlv"]["x"] + $alt["nlv"]["y"];
	#ned lav høyre:
	$alt["nlh"]["x"] = ($rute['x'] + 1);
	$alt["nlh"]["y"] = ($rute['y'] - 2);
	$sum["nlh"] = $alt["nlh"]["x"] + $alt["nlh"]["y"];
	#ned høy høyre:
	$alt["nhh"]["x"] = ($rute['x'] + 2);
	$alt["nhh"]["y"] = ($rute['y'] - 1);
	$sum["nhh"] = $alt["nhh"]["x"] + $alt["nhh"]["y"];

	arsort($sum);
	echo "alle alternativ:\n";
	print_r($alt);
	echo "summen av rutene:\n";
	print_r($sum);
	echo "denne rutesum:\n$current\n";
	echo "naermeste rutesum:\n";
	
	$cv = getClosest($current,$sum);				#finn nærmeste rutesum
	echo $cv."\n";
	$sort = array_count_values($sum);
	echo "hvor mange rutesummer av hver sort:\n"; print_r($sort);
	if($sort[$cv] > 1) {							#Sjekk om det fins flere ruta med samme sum
		foreach($sum as $retn=>$v) 					#loop gjennom alle mulighetene
			if($v==$cv)								#velg kun de som er nærmest
				$yup[$retn] = array('x'=>$alt[$retn]["x"],'y'=>$alt[$retn]["y"]);
		asort($yup);								#sorter de nærmeste etter x lav og y lav
		echo "naermeste ruter sortert, lav x foerst, lav y etter:\n";print_r($yup);
		return array_shift($yup);					#hent ut den neste ruta
	}
	else
		return $alt[array_search($cv, $sum)]; 		#neste rute dersom det kun er en verdi nærmest
}

$rute['x']=-1;
$rute['y']=3;
$start = time();
$end=1;
echo "naavaerende rute:\n";
print_r($rute);
for($i=1;$i<=$end;$i++) {
	$rute = flyttSpringer($rute);
	
	if($i % 100000 == 0) {
		$s = time() - $start;
		$m = floor($s / 60);
		$h = floor($m / 60);

		$mins = ($m %  60);
		$seconds =  ($s % 60);
		$isotime = sprintf("%02d:%02d:%02d", $h, $mins, $seconds);
		$msg = "runtime: ".$isotime;
		echo $i." out of\n$end\nposisjon: x=".$rute['x']." y=".$rute['y']."\n$msg\n\n";
	}
}
echo "neste rute:\n";
print_r($rute);
?>