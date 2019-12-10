<?php
#Løsning av Bullhill
for($x = 2; $x <= 24; $x++){
	for($y=1;$y <= 27644436; $y++){
		if((($y * $x) % 27644437) == 1){
			echo $x . ": Kode: ". (($y * 5897) % 27644437) . "\n";
			break;}}}