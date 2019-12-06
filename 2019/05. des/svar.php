<?php
$string = "tMlsioaplnKlflgiruKanliaebeLlkslikkpnerikTasatamkDpsdakeraBeIdaegptnuaKtmteorpuTaTtbtsesOHXxonibmksekaaoaKtrssegnveinRedlkkkroeekVtkekymmlooLnanoKtlstoepHrpeutdynfSneloietbol";

# Reverser No 3
$three = str_split($string, 3);
krsort($three);
$string = implode($three);

# Reverser No 2
$two = str_split($string, 2);
foreach ($two as $k=>$v)
    $two[$k]=strrev($v);
$string = implode($two);

# Reverser No 1
$one = str_split($string, strlen($string)/2);
echo $one[1].$one[0];

#HestTubaTrompetKattungeIpadBakeredskapDatamaskinTrekkspillLekebilKanarifuglKnallpistolMobiltelefonSydenturHoppeslottKanonLommelyktVekkerklokkeRedningsvestKaraokemaskinXboxOst