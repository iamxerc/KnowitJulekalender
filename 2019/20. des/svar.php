<?php
### UFERDIG OG FEIL -> forkasta alt og gikk videre til svar2.php
include "primenums.php";
$elfwork = [0,0,0,0,0,0];
$DEBUG = [];
function next_elf($elf, $dir, $pass=0) {
    if($dir == 'cw') {
        $elf += 1 + $pass;
    } else {
        $elf -= 1 - $pass;
    }
    if($elf > 5 or $elf < 0) 
        $elf = $elf % 5;
    elseif($elf == 0) 
        $elf = 5;
        
    return $elf;
}
function is_prime($step) {
    global $primenums;
    return !(array_search($step, $primenums) === false);
}
function next_hardest_worker($elf, $dir) {
    global $elfwork;
    $temp = $elfwork;
    sort($temp);
    if($temp[0] == $temp[1]) 
        return false;
    elseif($elfwork[next_elf($elf, $dir)] == $temp[0]) 
        return true;
    else 
        return false;
}
function next_step($step, $elf, $dir) {
    global $elfwork, $DEBUG;
    $rule1=$rule2=$rule3=$rule4=$rule5=false;
    $pass = 0;
    $nextelf = [];
    #stop when done
    if($step % 10000 == 0) echo "$step steg ferdig\n";
    #if($step > 1000740) { print_r($elfwork); die; }
    if($step > 8) { print_r($DEBUG); print_r($elfwork); die; }
    
    $elfwork[$elf] += 1;
    #rule 1
    if(is_prime($step)) {
        $nextelf[] = next_elf($elf, $dir);
        $rule1 = true;
        $DEBUGrule[]=1;
    }
    #rule 2
    if($step % 28 == 0) {
        $dir = ($dir == 'cw' ? 'ccw' : 'cw');
        $nextelf[] = next_elf($elf, $dir);
        $rule2 = true;
        $DEBUGrule[]=2;
    }
    #rule 3
    if($step % 2 == 0 && next_hardest_worker($elf, $dir)) {
        $nextelf[] = next_elf($elf, $dir, 1);
        $rule3 = true;
        $DEBUGrule[]=3;
    }
    #rule 4
    if($step % 7 == 0) {
        $nextelf[] = 5;
        $rule4 = true;
        $DEBUGrule[]=4;
    }
    #$rules = $rule1 + $rule2 + $rule3 + $rule4; # Drit i det her, sjekk KANDIDATA istedet. om flere next_elf e samma
    #if($rules > 1 && $rule2)
        
    #if($rules > 1 && $rule3)
    #    $pass = 1;
    
    #rule 5
    if(count($nextelf) > 1 || empty($nextelf)) {
        if(count($nextelf) > 1 && $rule2)  #hvis regel 2 ikke blir brukt, reset dir tilbake til normal.
            $dir = ($dir == 'cw' ? 'ccw' : 'cw');
        $DEBUGelf = $nextelf;
        $nextelf = next_elf($elf, $dir);
        $rule5 = true;
        $DEBUGrule[]=5;
    } else {
        $DEBUGelf = $nextelf;
        $nextelf = $nextelf[0];
    }
    #$nextelf = next_elf($elf, $dir, $pass);
    #if($rules > 1 && $rule4)
    #    $nextelf = 5;
    #if($rules < 1) {
    #    $rule5 = true;
    #    $DEBUGrule[]=5;
    #}

    $rule = ($rule1 ? 1 : ($rule2 ? 2 : ($rule3 ? 3 : ($rule4 ? 4 : ($rule5 ? 5 : 'error')))));
    $DEBUG[] = ['step'=>$step, 'elf'=>$elf, 'nextelf'=>$nextelf, 'candidates'=>$DEBUGelf, 'dir'=>$dir, 'rule'=>$DEBUGrule,'usedrule'=>$rule];
    
    next_step($step+1, $nextelf, $dir);
    
    die("what step");
}

next_step(1,1,'cw');
die("HMM");
