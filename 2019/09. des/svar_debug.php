<?php
function is_krampus($n) {
    $v = pow($n,2);
    $DEBUG = "N: ".$n." POW: ".$v."\n";
    for($i=1;$i<=strlen($v)-1;$i++) {
        $a = substr($v,0,$i);
        $b = substr($v,$i,strlen($v)-1);
        $DEBUG .= "(".$i.") A: ".str_pad($a,7)." + (".$i."-".(strlen($v)-1)."=".((strlen($v))-$i).") B: ".str_pad($b,10)." SUM: ".($a+$b)."\n";
        if(abs($a) + abs($b) == $n && $a > 0 && $b > 0) {
            $DEBUG .= "-------------";
            echo "<pre>".$DEBUG."</pre>";
            return true;
        }
    }
    return false;
}

$sum=0;
$numbers = file("data.txt");
foreach($numbers as $n)
    if(is_krampus((int) $n))
        $sum += (int) $n;
echo $sum;
#445372