<?php
$dragon = 50;
$hungry_days = 0;
$spare_sheep = 0;
$day = 0;
$file = file_get_contents('data.txt');
$sheeps = explode(',', $file);

foreach($sheeps as $sheep) {
    if($sheep == $dragon) {
        $hungry_days=0;
        #$spare_sheep from before stays the same
        $dragon++;
    }
    elseif(($sheep+$spare_sheep)>$dragon) { 
        $hungry_days=0; 
        $spare_sheep = $spare_sheep + ($sheep - $dragon);
        $dragon++; 
    }
    elseif(($sheep+$spare_sheep)==$dragon) { 
        $hungry_days=0; 
        $spare_sheep=0; 
        $dragon++; 
    }
    elseif(($sheep+$spare_sheep)<$dragon) { 
        $hungry_days++; 
        $spare_sheep=0; 
        $dragon--; 
    }
    if($hungry_days==5) { die($day); }
    $day++;
}
die($day);

#7602
?>