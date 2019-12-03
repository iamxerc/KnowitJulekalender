<?php
/*
142453146368 % 26 = 25
5478967167 % 26 = 10
210729506 % 26 = 25
8104980 % 26 = 25
311729 % 26 = 14
11989 % 26 = 2
461 % 26 = 18
17 % 26 = 16
*/

/*
$lol = Array_reverse(Array(25,10,25,25,14,2,18,16));
foreach($lol as $chr) {
	echo chr(65+$chr);
}*/

function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
echo getNameFromNumber(142453146368);

#QSCOZZKZ