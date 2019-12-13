<?php
$numit=0;
foreach(range(1000,9999) as $i) {
    for($res = $i, $x = 0; $res != 6174 && $res != 0; $x++) {
        $split = str_split(str_pad($res,4,0,STR_PAD_LEFT));      
        sort($split);  
        $desc = implode($split);
        rsort($split);
        $asc = implode($split);
        $res = $asc - $desc;
    }
    if($x == 7) $numit++;
}
echo $numit;
#1980