<?php
function checkPrime($num) {
    if($num == 1) return false;
    if($num == 2) return true;
    if($num % 2 == 0) return false;
    for($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2)
        if($num % $i == 0)
            return false;
    return true;
}

$a = 0;
for( $i = 0; $i <= 1000; $i++) if(checkPrime($i) && checkPrime(strrev($i)) && $i != strrev($i)) $a++;
echo $a;

/*
$a = 0;
for( $i = 0; $i <= 1000; gmp_nextprime($i)) if(gmp_prob_prime(strrev($i)) && $i != strrev($i)) $a++;
echo $a;
*/