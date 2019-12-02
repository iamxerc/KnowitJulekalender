<?php
# Løsning av Silverfast
$stop = 2147483647;
$day = 60*60*25;
echo gmdate('Y-m-d\T-H:i:s\Z', ($stop%$day)+(intval($stop/$day)*60*60*24));
