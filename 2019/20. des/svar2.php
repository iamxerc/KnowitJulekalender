<?php
$start = microtime(true);
include "primenums.php";

function is_prime($step) {
    global $primenums;
    return !(array_search($step, $primenums) === false);
}
function rotate_elf($elf) {
    return ((5 + ($elf % 5)) % 5); # modulo kuker med negative nummer
}
function next_hardest_worker($work, $elf, $dir) {
    $max = array_keys($work, max($work));
    $elf += $dir;
    $elf = rotate_elf($elf);
    if(count($max) == 1 && $max[0] == $elf)
        return true;
    else
        return false;
}
function laziest_worker($work) {
    $min = array_keys($work, min($work));
    if(count($min) == 1)
        return $min[0];
    else
        return false;
}
function run($stop, $step, $work, $elf, $dir) {
    $function = ['rule1','rule2','rule3','rule4','rule5'];
    
    for(;$step<=$stop;$step++) {
        $lazyelf = laziest_worker($work); # Hvis bare en alv har gjort minst, velg han.
        if($lazyelf !== false && is_prime($step)) {
            $elf = $lazyelf;
        } elseif($step % 28 == 0) {
            $dir = ($dir == 1 ? -1 : 1); # bytt retning
            $elf += $dir;
        } elseif($step % 2 == 0 && next_hardest_worker($work, $elf, $dir)) {
            $elf += $dir * 2; # -1*2==-2, 1*2==2 (hopp over en)
        } elseif($step % 7 == 0) {
            $elf = 4; # num 4 er alv 5, 0=1 pga modulo sjekk senere
        } else {
            $elf += $dir;
        }
        $elf = rotate_elf($elf);
        $work[$elf] += 1;
    }
    return $work;
}
$work = [1,0,0,0,0];
$run = run(1000740, 2, $work, 0, 1);
echo max($run) - min($run);
echo "\n".(microtime(true)-$start)." sec";
#22766