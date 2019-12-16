<?php
function moveBirte($way) {
    global $birte, $direction, $map, $chDir;
    list($x,$y) = $birte;
    list($dx,$dy) = $direction[$way];
       
    $birte = [$x+$dx,$y+$dy];
    if($x != 1) 
        $map[$x][$y] = ($way != "north" ? '\\' : '/');
    
    if(count($map) <= $x+1) { #Finished
        $map = array_map(function($line) { return implode('', $line); }, array_map(null, ...$map)); #flip array horizontal
        $handle = fopen("data_new.txt", "w");   # Create 
        foreach($map as $line)                  # new file,
            fwrite($handle, $line."\n");        # containing
        fclose($handle);                        # Birte's path
        echo "<pre>".file_get_contents("data_new.txt");
        die("<h1>$chDir</h1>");
    }
    
    if($map[$x][$y+($dy*3)] == "#" || $map[$x+1][$y+($dy*3)] == "#") { #check if 20m away from shore during turn
        $chDir++;
        $birte = [$x+1,$y]; #move ahead during turn
        moveBirte(($way == 'north' ? 'south' : 'north')); #change direction
    }
    
    moveBirte($way); #continue same way
}

$chDir=0;
$birte = [0,0];
$direction = ['north' => [1,  -1], 'south'  => [1, 1]];
$data = file("data.txt");
$data = array_map('str_split', $data);
$map = array_map(null, ...$data); #flip array vertical

foreach($map as $x => $field) 
    foreach($field as $y => $sign)
        if($sign == "B") 
            $birte = [$x, $y]; #assign start position
        elseif($sign != "#")
            $map[$x][$y] = " "; #fill in water to draw path

moveBirte('north');