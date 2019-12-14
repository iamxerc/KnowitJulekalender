<?php
$map = json_decode(file_get_contents("data.txt"), true);
class MazeRobot {
    function __construct($order) {
        $this->position = [0,0];
        $this->order = $order;
        $this->log = [];
        $this->direction = ['south'=>[1,0], 'east'=>[0,1], 'north'=>[-1,0], 'west'=>[0,-1]];
        $this->conv = ['south'=>'bottom','east'=>'right','north'=>'top','west'=>'left'];
        $this->reversePosition = [];
    }
    function stop() {
        return $this->position == [499,499];
    }
    function been($i) {
        list($dy,$dx) = $this->direction[$i];
        list($y,$x) = $this->position;
        $newposition = [$y+$dy,$x+$dx];
        return array_key_exists(implode(',',$newposition), $this->log);
    }
    function blocked($i) {
        global $map; 
        list($y, $x) = $this->position;
        return $map[$y][$x][$this->conv[$i]];
    }
    function move() {
        foreach($this->order as $i) {
            if($this->been($i)) continue;
            if($this->blocked($i)) continue;
            list($dy,$dx) = $this->direction[$i];
            list($y,$x) = $this->position;
            $this->position = [$y+$dy, $x+$dx];
            $this->log[implode(',',$this->position)] = true;
            array_push($this->reversePosition, $this->position);
            return;
        }
        array_pop($this->reversePosition);
        $this->position = end($this->reversePosition);
    }
}
// For an array of n words, return an array of n! strings, each containing the words in a different order.
function wordcombos ($words) {
    if ( count($words) <= 1 ) {
        $result = $words;
    } else {
        $result = array();
        for ( $i = 0; $i < count($words); ++$i ) {
            $firstword = $words[$i];
            $remainingwords = array();
            for ( $j = 0; $j < count($words); ++$j ) {
                if ( $i <> $j ) $remainingwords[] = $words[$j];
            }
            $combos = wordcombos($remainingwords);
            for ( $j = 0; $j < count($combos); ++$j ) {
                $result[] = $firstword . ' ' . $combos[$j];
            }
        }
    }
    return $result;
}
$combinations = wordcombos(['south','east','west','north']);
$objects = [];
foreach($combinations as $num=>$combo) {
    $objects[$combo] = new MazeRobot(explode(' ',$combo));
    while (!$objects[$combo]->stop()) {
        $objects[$combo]->move();
    }
    file_put_contents("generated/".$combo.".log", serialize($objects[$combo]->log));
    echo $combo." has visited ".count($objects[$combo]->log)." rooms\n";
}

/*
$arthur = new MazeRobot(['south','east','west','north']);
while (!$arthur->stop()) {
    $arthur->move();
}
file_put_contents("generated/arthur.log", serialize($arthur->log));

$isaac = new MazeRobot(['east','south','west','north']);
while (!$isaac->stop()) {
    $isaac->move();
}
file_put_contents("generated/isaac.log", serialize($isaac->log));


echo abs(count($arthur->log) - count($isaac->log));*/
#99079