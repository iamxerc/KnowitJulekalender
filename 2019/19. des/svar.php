<?php
function hp($i) {
    $r = strrev($i);
    return ($i != $r ? ($i + $r == strrev($i + $r)) : false);
}
for($i=0, $sum=0; $i<=123454321; $i++, (hp($i) ? $sum += $i : ''));
echo $sum;
#659277075458904