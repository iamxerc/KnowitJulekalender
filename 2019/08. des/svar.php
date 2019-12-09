<?php 
function PLUSS4($num) {
    return $num + 4;
}
function PLUSS101($num) {
    return $num + 101;
}
function MINUS9($num) {
    return $num - 9;
}
function MINUS1($num) {
    return $num - 1;
}
function REVERSERSIFFER($num) {
    return ($num < 0 ? -(int) strrev($num) : (int) strrev(abs($num)));
}
function OPP7($num) {
    if($num < 0 && $num > -6)
        $abs = 7;
    elseif($num < 0) {
        for($abs=abs($num);$abs % 10 != 7;$abs--);
        $abs = -(int) $abs;
    } else 
        for($abs=abs($num);$abs % 10 != 7;$abs++);
    return $abs;
}
function GANGEMSD($num) {
    return $num * max(str_split($num));
}
function DELEMSD($num) {
    return ($num == 0 ? 0 : floor($num / max(str_split($num))));
}
function PLUSS1TILPAR($num) {
    $arr = str_split(abs($num));
    foreach($arr as $k=>$v)
        if($v % 2 == 0 /*&& $v != 0*/) 
            $arr[$k] = $v + 1;
    $res = implode($arr);
    return ($num < 0 ? -(int) abs($res) : abs($res));
}
function TREKK1FRAODDE($num) {
    $arr = str_split(abs($num));
    foreach($arr as $k=>$v)
        if($v % 2 == 1) 
           /*if($v-1 == 0)
                unset($arr[$k]);
            else*/
                $arr[$k] = $v - 1;
    $res = implode($arr);
    return ($num < 0 ? -(int) abs($res) : abs($res));
}
function ROTERPAR($num) {
    global $wheel;
    foreach($wheel as $k=>$v)
        if($k % 2 == 0)
            ROTER($k);
    return $num;
}
function ROTERODDE($num) {
    global $wheel;
    foreach($wheel as $k=>$v)
        if($k % 2 == 1)
            ROTER($k);
    return $num;
}
function ROTERALLE($num) {
    global $wheel;
    foreach($wheel as $k=>$v)
        ROTER($k); 
    return $num;
}
function STOPP($num) {
    global $prizes, $rungame;
    $prizes[] = $num;
    $rungame = false;
    return $num;
}
function ROTER($k) {
    global $wheel;
    array_push($wheel[$k], array_shift($wheel[$k])); 
}

$file = file("data.txt");
$originalwheel =  array();
$prizes = array();
foreach($file as $k=>$v) {
    $originalwheel[$k] = explode(", ", trim(substr(strstr($v, ": "), 1)));
}

echo "<pre>";
$DEBUG = "";

for($i=1;$i<=10;$i++) {
    $rungame = true;
    $profit = $i;
    $wheel = $originalwheel;
    $DEBUG .= "<h1>GAME STARTED WITH $i COINS:</h1>";
    $it=1;
    do {
        $tmp = str_split($profit);
        $profit = $wheel[end($tmp)][0]($profit); 
        $tmp2 = str_split($profit);
        $DEBUG .= "OP: $it   \tWHEEL ".end($tmp).": ".str_pad(trim(str_replace(array("\n", " "), '', print_r($wheel[end($tmp)], true))), 70)."BET: ".implode($tmp)."   \tRUN: ".str_pad($wheel[end($tmp)][0], 13)."\tPROFIT: $profit  \tNEXT WHEEL: ".end($tmp2)."\n";
        ROTER(end($tmp));
        $it++;
    } while($rungame);
}

echo "PRIZES: ";
print_r($prizes);
rsort($prizes); 
echo "HIGHEST PRIZE: ".$prizes[0]; 
print_r($DEBUG);