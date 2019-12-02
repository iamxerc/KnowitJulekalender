<?php
function romanic_number($integer, $upcase = true) { 
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
    $return = ''; 
	if($integer == 0) return '0';
    while($integer > 0) { 
        foreach($table as $rom=>$arb) { 
            if($integer >= $arb) { 
                $integer -= $arb; 
                $return .= $rom; 
                break; 
            } 
        } 
    } 
    return $return; 
}
function chrnum($l) {
	#return array_combine(range('a','z'),range(1,26))[$l];
	return ord($l)-96;
}

$string = "Your message was received with gratitude! We do not know about you, but Christmas is definitely our favourite holiday. The tree, the lights, all the presents to unwrap. Could there be anything more magical than that?! We wish you a happy holiday and a happy new year!";
$strip = array('!','?','.',',',' ');
$msg = str_split(strtolower(str_replace($strip,'',$string)));
$min = 0;
$max = count($msg)*2;

foreach($msg as $char) {
	if(chrnum($char) % 2 == 0) {
		$crypt[$min++] = romanic_number(chrnum($char) / 2);
		$crypt[$max--] = romanic_number(chrnum($char) / 2);
	} else {
		$crypt[$min++] = romanic_number((chrnum($char)+1) / 2);
		$crypt[$max--] = romanic_number((chrnum($char)-1) / 2);
	}
}
ksort($crypt);
echo implode(", ",$crypt);