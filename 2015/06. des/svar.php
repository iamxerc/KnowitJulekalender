<?php
function permuteUnique($items, $perms = [], &$return = "") {
	global $match, $y;
    if (empty($items)) {
		unset($return);
        $return = implode($perms);
		$ql = strlen($return);
		$z=0; $val=0;
		foreach($perms as $num) {
			$z++; $y++;
			if($num == 1)
				$val++;
			else
				$val--;
			if($val < 0)
				break; # Ikke alle paranteser rekker å bli lukket
			
			if($z==$ql || $val == 0)
				$match++; # Alle paranteser er lukket
			
			# if($z==$ql && $val != 0) Ikke alle paranteser ble lukket
		}
    } else {
        sort($items);
        $prev = false;
        for ($i = count($items) - 1; $i >= 0; --$i) {
            $newitems = $items;
            $tmp = array_splice($newitems, $i, 1)[0];
            if ($tmp != $prev) {
                $prev = $tmp;
                $newperms = $perms;
                array_unshift($newperms, $tmp);
                permuteUnique($newitems, $newperms, $return);
            }
        }
        return $return;
    }
}
$match=0; $y=0;
permuteUnique(str_split("11111111111110000000000000"));
echo " $match matches after ".number_format($y,0,0," ")." loops in ".number_format((microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]),2)." sec";