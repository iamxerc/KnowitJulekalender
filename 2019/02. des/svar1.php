<?php
$rain=0;
$water=0;
$lines = file('data.txt');
foreach($lines as $line) {
    $trimarr = str_split(strstr($line, "#"));
    foreach($trimarr as $sign)
        if($sign == "#") { $water += $rain; $rain=0; }
        else $rain++;
    $rain=0;
}
echo $water;

#29564
?>