<?php
$string = file_get_contents('data.txt');
$arr = explode(", ", substr($string, 1, -1));
$romans = array('M' => 1000,'CM' => 900,'D' => 500,'CD' => 400,'C' => 100,'XC' => 90,'L' => 50,'XL' => 40,'X' => 10,'IX' => 9,'V' => 5,'IV' => 4,'I' => 1,);

foreach($arr as $v) {
	$result = 0;
	foreach ($romans as $key => $value) {
		while (strpos($v, $key) === 0) {
			$result += $value;
			$v = substr($v, strlen($key));
		}
	}
	$t[] = $result;
}

while(count($t) > 1) {
	$first = array_shift($t);
	$last = array_pop($t);
	$letter .= chr($first + $last + 64);
}

echo $letter;