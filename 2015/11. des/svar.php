<?php
function rom2int($rom,$romval=array()){
    $romval=array('M'=>1000,'D'=>500,'C'=>100,'L'=>50,'X'=>10,'V'=>5,'I'=>1);
    $arab=0;
    foreach($romval as $L=>$V){
        while(strpos($rom,$L)!==false){
            $l=$rom[0];
            $rom=substr($rom,1);
            $m=$l==$L?1:-1;
            $arab += $romval[$l]*$m;
        }
    }
    return $arab;
}

$v = file('http://pastebin.com/raw.php?i=p1eVAM5H', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach($v as $x) {
	if($x[0] == "0" && $x[1] == "b") { 
		$y[] = $x;
		$z[] = bindec($x);
	}
	elseif($x[1] != "b" && !intval($x)) { 
		$y[] = $x; 
		$z[] = rom2int($x); 
	}
	elseif(intval($x)) { 
		$y[] = $x; 
		$z[] = $x; 
	}
}
asort($z);
echo $y[current(array_flip(array_slice($z,floor(count($z)/2), -(floor(count($z)/2)), true)))];