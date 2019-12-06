<?php
#Svar fra dappa
$wish = 'tMlsioaplnKlflgiruKanliaebeLlkslikkpnerikTasatamkDpsdakeraBeIdaegptnuaKtmteorpuTaTtbtsesOHXxonibmksekaaoaKtrssegnveinRedlkkkroeekVtkekymmlooLnanoKtlstoepHrpeutdynfSneloietbol';

$wish = implode(array_reverse(str_split($wish, 3)));
$wish = implode(array_map('strrev', str_split($wish, 2)));
$wish = implode(array_reverse(str_split($wish, strlen($wish) / 2)));

echo $wish;

#HestTubaTrompetKattungeIpadBakeredskapDatamaskinTrekkspillLekebilKanarifuglKnallpistolMobiltelefonSydenturHoppeslottKanonLommelyktVekkerklokkeRedningsvestKaraokemaskinXboxOst