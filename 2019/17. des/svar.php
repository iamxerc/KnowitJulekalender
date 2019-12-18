<?php
function is_triangular($n) {    #funksjon som jeg brukte for å bruteforce tall til å begynne med(jævla tregt)
    $a = 8 * $n + 1;
    return is_square($a);
}
function find_triangular($n) {
    return ($n * ($n + 1) / 2);
}
function is_square($n) {
    return (floor(sqrt($n)) == ceil(sqrt($n)));
}
function is_rotated_square($n) {
    if($n == 0) return 0.1; #off-by-one case
    if(is_square($n)) return $n;
    
    $a = str_split($n);
    for($i=1;$i<=strlen($n);$i++,array_push($a, array_shift($a))) 
        if(is_square(abs(implode('',$a)))) 
            return $n;
}
function walk_rotated_square(&$n) {
    if($n == 0) { $n = 1; return; }
    if(is_square($n)) { $n = 1; return; }
    
    $a = str_split($n);
    for($i=1;$i<=strlen($n);$i++,array_push($a, array_shift($a))) {
        (is_square(abs(implode('',$a))) ? $n=1 : $n=0); return;
    }
}

$tri = [];
$k=0;
for($i=0;count($tri)<1000000;$k=find_triangular(++$i))
    $tri[] = $k;


$tri_sq = [];
foreach($tri as $value)
    if(is_rotated_square($value)) 
        $tri_sq[] = $value;

echo count($tri_sq);
#74
