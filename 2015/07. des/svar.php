<?php
$a = Array();
for( $i = 0; $i <= 1000; $i++ )	if( $i % 7 == 0 && strrev($i) % 7 == 0) $a[] = $i;
echo array_sum($a);