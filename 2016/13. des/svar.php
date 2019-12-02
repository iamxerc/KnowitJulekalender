<?php
$start = microtime(true);
function toggle($inst,$val=0){
	if($inst == 'turn on') return 1;
	elseif($inst == 'turn off') return 0;
	else return ($val==0?1:0);
}

$instr = file('http://pastebin.com/raw/aTeSBwR4', FILE_IGNORE_NEW_LINES);
foreach($instr as $line) {
	list($do, $startx, $starty, $stopx, $stopy) = preg_split("/(turn on|turn off|toggle) (\d+),(\d+) through (\d+),(\d+)/", $line, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
	$startx = (int) $startx; #idiotfeilen sjøl: 09 vs 9
 	if($stopx - $startx < 0 || $stopy - $starty < 0) continue;

	for($x=$startx;$x<=$stopx;$x++)
		for($y=$starty;$y<=$stopy;$y++)
			$grid[$x][$y] = toggle($do,@$grid[$x][$y]);
}
foreach($grid as $arr)
	@$count += array_sum($arr);
	
echo "Lights on: $count\n";
echo "Runtime: ".number_format((microtime(true)-$start),2)."s\n";

#6866581