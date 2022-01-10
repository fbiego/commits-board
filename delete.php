<?php

$file = file_get_contents("countries.json");
$json = json_decode($file, true);
foreach ($json as $i => $j)
{
	unlink($i . "/index.php");
}

?>
