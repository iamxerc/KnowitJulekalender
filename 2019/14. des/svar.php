<?php
$alphabet = [2, 3, 5, 7, 11];
$seqNo = 217532235;
$seq = [];
$sum7 = 0;
$i = 0;

while(true) {
    foreach($alphabet as $numAdd) {
        $lastCount = count($seq);
        for($x=0;$x<($i==0?$alphabet[0]:$seq[$i]);++$x) {
            $seq[] = $numAdd;
            if($numAdd == 7)
                $sum7 += 7;
            if(count($seq) >= $seqNo) 
                break 3;
        }
        $i++;
    }
}
echo $sum7;
