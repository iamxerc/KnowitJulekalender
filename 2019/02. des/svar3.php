<?php
#Løsning av NChief
echo substr_count(implode("\n", array_map('trim', explode("\n", file_get_contents('data.txt')))), ' ');

#29564
?>