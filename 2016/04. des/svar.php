<?php
# Ingen løsning, var ikke tilgjengelig denne dagen

# Annen person sin php løsning:
for($b=$i=1;$i<=1337;$i++){
  if(strpos($i,'7') !== false || $i % 7 === 0){
    $a[$i] = $a[$b];
    $b++;
  }else{
    $a[$i] = $i;
  }
}
echo $a[1337];