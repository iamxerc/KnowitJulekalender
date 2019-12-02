<?php
$stige = array(3=>17, 8=>10, 15=>44, 22=>5, 39=>56, 49=>75, 62=>45, 64=>19, 65=>73, 80=>12, 87=>79);

for($n=1;$n<=1337;$n++)
	$p[$n] = 1;

$i = 1; 
$ant = 0;
$moves = fopen("data.txt", 'r');
while($info = fscanf($moves,'%d')) {
	list($move) = $info;
	$nyrute = $p[$i] + $move;
	
	if($nyrute == 90)
		break;

	if($nyrute < 90)
		if($stige[$nyrute]) {
			$p[$i] = $stige[$nyrute];
			$ant++;
		} else 
			$p[$i] = $nyrute;
	
	if($i == 1337) 
		$i = 1; 
	else 
		$i++;
	
}
fclose($moves);
echo $i*$ant;