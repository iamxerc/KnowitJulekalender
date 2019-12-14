<?php
$map = json_decode(file_get_contents("data.txt"));

class drawMap {
    function __construct($robot) {
        $this->robot = $robot;
        $this->start = microtime(true);
        $this->html = "<table style='border-collapse:collapse;'>\n";
        if(file_exists($this->robot.".log"))
            $this->log = unserialize(file_get_contents($this->robot.".log"));
        
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
        file_put_contents($this->robot.".html", $this->html);
        $this->stop = microtime(true);
        echo "Runtime ".$this->robot.": ".($this->stop - $this->start)." seconds.\n";
    }
}

$maps = new drawMap('map');
$maps->draw();

$arthur = new drawMap('arthur');
$arthur->draw();

$isaac = new drawMap('isaac');
$isaac->draw();