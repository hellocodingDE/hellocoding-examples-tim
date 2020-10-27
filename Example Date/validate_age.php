<?php

$alter = floor((time() - strtotime("01.01.2000"))/31556926);
echo "Der Nutzer ist: ".$alter." Jahre alt<br>";

if ($alter >= 18) {
  echo "Nutzer ist volljährig";
} else {
  echo "Nutzer ist minderjährig";
}
