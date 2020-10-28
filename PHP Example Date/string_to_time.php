<?php
$timestring = date("d.m.Y H:i:s");
echo "String: ".$timestring."<br>";
echo "Timestamp: ".strtotime($timestring);
