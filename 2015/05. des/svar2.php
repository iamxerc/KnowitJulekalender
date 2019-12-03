<?php
foreach(file('http://pastebin.com/raw.php?i=sGbqMyCa', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $w) {
	$s = str_split($w,1);
	sort($s);
	$a[implode($s)]++;
}
foreach($a as $t)
	if($t > 1)
		$m += $t;
echo $m;
