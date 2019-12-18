<?php
function find_triangular($n) {
    return ($n * ($n + 1) / 2);
}
function is_square($n) {
    return (floor(sqrt($n)) == ceil(sqrt($n)));
}
function is_rotated_square($n) {
    if($n == 0) return 0.1; #off-by-one case
    $a = str_split($n);
    for($i=1;$i<=strlen($n);$i++,array_push($a, array_shift($a))) 
        if(is_square(abs(implode('',$a)))) 
            return $n;
}

$n=$trisq=$tri=0;
for($i=0;$tri++<1000000;$n=find_triangular(++$i))
    if(is_rotated_square($n)) $trisq++;
echo $trisq;
#74