<?php

$output = '';
$returncode = 1;
echo "### LAST-RETURN-LINE ".exec('ls -la', $output, $returncode)."\n"; // output last line from return
echo "Returncode: ".$returncode."\n"; // 0 = success ;; != 0 -> error
print_r($output); // prints all lines as array
