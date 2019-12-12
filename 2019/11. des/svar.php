<?php
$str = file_get_contents("data.txt");
$fart = 10703437;

for ($i=0; $i<strlen($str); $i++){
    switch($str[$i]) {
        case "G":
            $fart -= 27;
            break;
        case "I":
            for($x=1;;$x++) {
                $fart += (12 * $x);
                if($str[$i+$x] != "I") { 
                    $i += $x-1; 
                    break; 
                }
            }
            break;
        case "A":
            $fart -= 59;
            break;
        case "S":
            $fart -= 212;
            break;
        case "F":
            $fart -= 70;
            if($str[$i+1] == "F") {
                $fart += 35;
                $i++;
            }
            break;
    }
    if($fart<=0) break;
}
echo ($i+1);
#202128