<?php
$stunde  = 0;
$minute  = 0;
$sekunde = 0;

$monat = 1;
$tag   = 1;
$jahr  = 2021;

$timestamp = mktime($stunde, $minute, $sekunde, $monat, $tag, $jahr);
echo "Der \"01.01.2021 00:00:00\" ist ein: ".date("l", $timestamp);
