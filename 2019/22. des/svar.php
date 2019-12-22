<?php
$data = array_map('str_split', file("forest.txt"));
$forest = array_map(null, ...$data);
$m=0;
foreach($forest as $k=>$v)
    if($v[array_key_last($v)] == "#")
        $m += 0.2 * (array_key_last($v) + 1 - array_search("#", $v));
echo $m*200;
#6537400