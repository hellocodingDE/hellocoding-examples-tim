<?php
$timestamp = time();
echo "Timestamp jetzt: ".                 strtotime("now")."<br>";
echo "Timestamp am 10. September 2000: ". strtotime("10 September 2000")."<br>";
echo "Timestamp Morgen: ".                strtotime("+1 day", $timestamp)."<br>";
echo "Timestamp nächste Woche: ".         strtotime("+1 week", $timestamp)."<br>";
echo "Timestamp in einer Woche, 2 Tagen, 4 Stunden und 2 Sekunden: ".strtotime("+1 week 2 days 4 hours 2 seconds", $timestamp)."<br>";
echo "Timestamp nächsten Donnerstag: ".   strtotime("next Thursday", $timestamp)."<br>";
echo "Timestamp letzten Montag: ".        strtotime("last Monday", $timestamp)."<br>";
