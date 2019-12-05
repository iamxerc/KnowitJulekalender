<?php
$locationX=0;
$locationY=0;
$min=0;
$history=array();
$csv = file("data.csv");
array_shift($csv); #remove x/y start of csv file

foreach($csv as $Target) {
    list($TargetX,$TargetY) = explode(',', $Target);
    
    #Move X right
    if($TargetX > $locationX)
        for($moveX = $locationX; $moveX <= $TargetX; $locationX = $moveX++)
            if($locationX!=$moveX)
                $history[] = $moveX.",".$locationY;
    #Move X left
    if($TargetX < $locationX)
        for($moveX = $locationX; $moveX >= $TargetX; $locationX = $moveX--)
            if($locationX!=$moveX)
                $history[] = $moveX.",".$locationY;
    #Move Y down
    if($TargetY > $locationY)
        for($moveY = $locationY; $moveY <= $TargetY; $locationY = $moveY++)
            if($locationY!=$moveY)
                $history[] = $locationX.",".$moveY;
    #Move Y up
    if($TargetY < $locationY)
        for($moveY = $locationY; $moveY >= $TargetY; $locationY = $moveY--)
            if($locationY!=$moveY)
                $history[] = $locationX.",".$moveY;
}

foreach(array_count_values($history) as $passes)
    if($passes > 1)
        for($i = 1; $i <= $passes; $min += $i++);
    else
        $min += 1;

echo $min;

#394426