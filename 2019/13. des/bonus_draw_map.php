<?php
$map = json_decode(file_get_contents("data.txt"));

class drawMap {
    function __construct($robot) {
        $this->robot = $robot;
        $this->start = microtime(true);
        $this->html = "<table style='border-collapse:collapse;'>\n";
        if(file_exists("generated/".$this->robot.".log"))
            $this->log = unserialize(file_get_contents("generated/".$this->robot.".log"));
        
    }
    function isVisited($pos) {
        if(!property_exists($this, 'log')) 
            return;
        if(array_key_exists(implode(',',$pos), $this->log))
            $this->html .= "background-color:green;";
    }
    function drawCell($cell) {
        $this->html .= "\t\t<td style='width:3px;height:3px;";
        $this->isVisited([$cell['y'],$cell['x']]);
        if($cell['bottom'] == true)
            $this->html .= "border-bottom:thin solid black;";
        if($cell['right'] == true)
            $this->html .= "border-right:thin solid black;";
        if($cell['top'] == true) 
            $this->html .= "border-top:thin solid black;";
        if($cell['left'] == true) 
            $this->html .= "border-left:thin solid black;";
        $this->html .= "'></td>\n";
    }
    function draw() {
        global $map;
        foreach($map as $y=>$arrX) {
            $this->html .= "\t<tr>\n";
            foreach($arrX as $x=>$obj) {
                list($cx, $cy, $top, $left, $bottom, $right) = array_pad((array) $obj,12,null);
                $this->drawCell((array) $obj);
            }
            $this->html .= "\t</tr>\n";
        }
    }
    function __destruct() {
        $this->html .= "</table>\n";
        file_put_contents("generated/".$this->robot.".html", $this->html);
        $this->stop = microtime(true);
        echo "Runtime ".$this->robot.": ".($this->stop - $this->start)." seconds.\n";
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
    $objects[$combo] = new drawMap($combo);
    $objects[$combo]->draw();
}
/*
$maps = new drawMap('map');
$maps->draw();

$arthur = new drawMap('arthur');
$arthur->draw();

$isaac = new drawMap('isaac');
$isaac->draw();

*/