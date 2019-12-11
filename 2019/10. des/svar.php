<?php
error_reporting(E_ALL & ~E_NOTICE);
$year = 2018;
$file = file("data.txt");

foreach($file as $num => $line) {
    $line = trim($line);
    if($line[0] != "*")
        $day = date("l", strtotime(substr($line, 0, -1)." ".$year));
    else {
        preg_match("/\* (?P<amount>\d+) (?P<metric>\w+) (?P<product>\w+)/", $line, $matches);
        ${$matches['product']} += $matches['amount'];
        ${$day.$matches['product']} += $matches['amount'];
    }
}
echo floor($tannkrem / 125) * floor($sjampo / 300) * floor($toalettpapir / 25) * $Sundaysjampo * $Wednesdaytoalettpapir;
#1888326000