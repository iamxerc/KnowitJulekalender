<?php
function firstname($str) {
    global $first,$gender,$starwars;
    $mf = ($gender == 'M' ? 0 : 1);
    $modulo = count($starwars[$mf]);
    $sum = array_sum(array_map('ord', str_split($first)));
    return $starwars[$mf][($sum % $modulo)];
}
function firstlastname($str) {
    global $starwars;
    $str = preg_replace('/\PL/u', '', $str); #Remove anything but characters
    $num = array_map(function ($a) { return ord(strtolower($a))-96; }, str_split($str));
    $sum = array_sum($num);
    return $starwars[2][($sum % count($starwars[2]))];
}
function secondlastname($str) {
    global $first,$last,$gender,$starwars;
    $initial = array_product(array_map('ord', str_split($str)));
    $length = strlen($first.($gender == 'F' ? $last : null));
    $value = $initial * $length;
    $split = str_split($value);
    rsort($split, SORT_NUMERIC);
    $product = abs(implode('',$split));
    return $starwars[3][($product % count($starwars[3]))];
}

#Get starwars names and arrange in list
$starwars = [];
$swnames = [];
$i=0;
foreach(file("names.txt") as $v)
    if(trim($v) == "---") 
        $i++;
    else 
        $starwars[$i][] = trim($v);

#Get employee names and calculate star wars names
$employees = file("employees.csv");
array_shift($employees);
foreach($employees as $k=>$csv) {
    list($first, $last, $gender) = str_getcsv($csv);
    $lastlen = strlen($last);
    list($last1, $last2) = explode("#", chunk_split($last, 
    /*First part of last name to be longest ═╤> */ ($lastlen % 2 != 0 ? ( $lastlen / 2 + 1 ) : ( $lastlen / 2 )),
    /*        if the length is odd.         ═╛  */  "#"));
    $swnames[] = firstname($first)." ".firstlastname($last1).secondlastname($last2);
}
$swnames = array_count_values($swnames);
arsort($swnames);
$swnames = array_flip($swnames);
echo array_shift($swnames);
#Malkili Deathfire