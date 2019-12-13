<?php
$map = json_decode(file_get_contents("data.txt"), true);
$start = microtime(true);
class MazeRobot {
    function __construct($order) {
        $this->position = [0,0];
        $this->order = $order;
        $this->log = [];
        $this->counter = 0;
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
        return (array_search($newposition, $this->log, true) == true);
    }
    function blocked($i) {
        global $map; 
        list($y, $x) = $this->position;
        return $map[$y][$x][$this->conv[$i]];
    }
    function move($name) {
        foreach($this->order as $i) {
            if($this->been($i)) continue;
            if($this->blocked($i)) continue;
            list($dy,$dx) = $this->direction[$i];
            list($y,$x) = $this->position;
            $this->position = [$y+$dy, $x+$dx];
            $this->log[] = $this->position;
            array_push($this->reversePosition, $this->position);
            $this->counter++;
            if($this->counter % 1000 == 0) echo $name." step no:".$this->counter."\n";
            return;
        }
        array_pop($this->reversePosition);
        $this->position = end($this->reversePosition);
    }
}

$arthur = new MazeRobot(['south','east','west','north']);
while (!$arthur->stop()) {
    $arthur->move('Arthur');
}
file_put_contents("arthur.log", serialize($arthur->log));
echo "Arthur: ".count($arthur->log)."\n";

$isaac = new MazeRobot(['east','south','west','north']);
while (!$isaac->stop()) {
    $isaac->move('Isaac');
}
file_put_contents("isaac.log", serialize($isaac->log));
echo "Isaac: ".count($isaac->log)."\n";

echo abs(count($arthur->log) - count($isaac->log));

$stop = microtime(true);
$min = floor(($stop - $start) / 60);
$sec = ($stop - $start) - ($min * 60);
echo "\nRuntime: $min min $sec sec"; #20-25min (lol)
