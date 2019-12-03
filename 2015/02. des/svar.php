<?php
$val = file('http://pastebin.com/raw.php?i=sJVZp7BH');
$res = Array();
foreach($val as $firstline=>$firstvalue) {
    foreach($val as $nextline=>$nextvalue) {
        if($nextline <= $firstline) continue;
        $res[] = $nextvalue - $firstvalue; 
    }
}
rsort($res);
echo number_format($res[0],4,".");