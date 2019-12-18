<?php
function swlast1($str) {
    #if($str == " " or $str == "'") return ord($str); #meh, fjern de.
    return ord(strtolower($str))-96;
}
function swlast2($str) { 
    global $first,$last,$gender;
    if($gender == 'F') $count = strlen($first."".$last);
    else               $count = strlen($first);
    $prod = array_product(array_map('ord', str_split($str)));
    $g_prod = $prod * $count;
    $g_split = str_split($g_prod);
    rsort($g_split, SORT_NUMERIC);
    return abs(implode('',$g_split)); 
}

#Get starwars names and arrange in list
$swfile = file("names.txt");
$starwars = [];
$swnames = [];
$i=0;
foreach($swfile as $v) {
    $v = trim($v);
    if($v == "---") 
        $i++;
    else 
        $starwars[$i][] = $v;
}

#Get employee names and calculate star wars names
$elist = file("employees.csv");
array_shift($elist);
#$elist = ["Jan,Johannsen,M"];
#$elist = ["Adelice,De Moreno,F", "Vasilis,D'Alesco,M"];
foreach($elist as $k=>$ecsv) {
    list($first, $last, $gender) = str_getcsv($ecsv);
    $swfirst = $starwars[( $gender == 'M' ? 0 : 1 )][( array_sum(array_map('ord', str_split($first))) % count($starwars[($gender == 'M' ? 0 : 1)]) )];
    $lastlen = strlen($last);
    list($last1, $last2) = explode("#", chunk_split($last, ($lastlen % 2 != 0 ? $lastlen/2+1 : $lastlen/2), "#"));
    $swlast1 = $starwars[2][( array_sum(array_map('swlast1', str_split(str_replace([" ", "'"], "", $last1)))) % count($starwars[2]) )];
    $swlast2  = $starwars[3][( swlast2($last2) % count($starwars[3]) )];
    
    $swnames[] = $swfirst." ".$swlast1.$swlast2;
    /*$swnames[$k] = ['first'=>$first,'last'=>$last,'gender'=>$gender,'swfirst'=>$swfirst,
                    'last1'=>$last1,'last2'=>$last2,'swlast1'=>$swlast1,'swlast2'=>$swlast2,
                    'swname'=>$swfirst." ".$swlast1.$swlast2];*/
}
$swnames = array_count_values($swnames);
arsort($swnames);
$swnames = array_flip($swnames);
echo array_shift($swnames);
#Malkili Deathfire