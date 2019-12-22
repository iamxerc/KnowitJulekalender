<?php
#Løsning fra Bullhill
$file = file_get_contents("generations.txt");
 
$generations = explode("\n", $file);
 
foreach($generations as $gen => $generation)
{
    $alv = explode(";", $generation);
    if($gen == 0)
    {
        foreach($alv as $child => $alvdata)
        {
            if($child %2 == 1)
            {
                $alvinfo = explode(",", $alvdata);
               
                $alver[$gen+1][$alvinfo[0]][$child] = true;
                $alver[$gen+1][$alvinfo[1]][$child] = true;
            }
        }
       
    }
    else
    {
        foreach($alv as $child => $alvdata)
        {
            $alvinfo = explode(",", $alvdata);
            if(isset($alver[$gen][$child]))
            {
                foreach($alver[$gen][$child] as $g0child => $dritt)
                {
                    $alver[$gen+1][$alvinfo[0]][$g0child] = true;
                    $alver[$gen+1][$alvinfo[1]][$g0child] = true;
                }
            }
        }
    }
    ksort($alver[$gen+1]);
    foreach($alver[$gen+1] as $alvid => $childs)
    {
        if(count($childs) >= 11869)
        {
            echo ($gen+1) . ":" . $alvid . " - " . count($childs) . "\n";
            die;
        }
    }
    echo date("H:i:s") . " Gen: ". $gen . "\n";
    unset($alver[$gen]);
}