<?php
$words = file('http://pastebin.com/raw.php?i=sGbqMyCa');
function trimword(&$value) {
	$value = trim($value);
} 
array_walk($words, trimword);
$matches=0;
foreach($words as $line=>$word) {
	foreach($words as $secline=>$secword) {
		if($line == $secline) continue;
		if(strlen($word) != strlen($secword)) continue;
		if(count_chars($word, 1) == count_chars($secword, 1)) {
			$matches++;
			break;
		}
	}
}
echo $matches;