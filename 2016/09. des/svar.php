<?php
$file = file('http://pastebin.com/raw/2vstb018', FILE_IGNORE_NEW_LINES);
foreach($file as $line) {
	list($sender,$mottaker,$cash) = explode(',', $line);
	$bank[$mottaker] += $cash;
	$bank[$sender] -= $cash;
}
foreach($bank as $saldo)
	if($saldo > 10) $i++;
echo $i;