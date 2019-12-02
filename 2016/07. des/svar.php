<?php
$fil = file('data.txt', FILE_IGNORE_NEW_LINES);
foreach($fil as $line) {
	$arr = explode(" ", $line);
	if($arr[3] == "north") {
		$lat += $arr[1];
	} elseif($arr[3] == "south") {
		$lat -= $arr[1];
	} elseif($arr[3] == "west") {
		$long += $arr[1];
	} elseif($arr[3] == "east") {
		$long -= $arr[1];
	}
}
echo $lat.",".$long;