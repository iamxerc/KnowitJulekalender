<?php
$num = '1111321112321111';
for($i = 0; $i < 50; $i++){
  $a = str_split($num);
  $num = '';
  $b = $a[0];
  unset($a[0]);
  $c = 1;
  foreach($a as $d){
    if($b === $d){
      $c++;
    }else{
      $num .= $c.$b;
      $b = $d;
      $c = 1;
    }
  }
  $num .= $c.$b;
}
echo  strlen($num);