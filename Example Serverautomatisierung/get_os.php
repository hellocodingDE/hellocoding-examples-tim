<?php
/*
  OS_UNKNOWN = 1;
  OS_WIN = 2;
  OS_LINUX = 3;
  OS_OSX = 4;
*/

function getOS() {
  switch (true) {
      case stristr(PHP_OS, 'DAR'):   return 4;
      case stristr(PHP_OS, 'WIN'):   return 2;
      case stristr(PHP_OS, 'LINUX'): return 3;
      default : return 1;
  }
}

echo "Ich glaube du benutzt ";

switch (getOS()) {
  case '2': echo "Windows"; break;
  case '3': echo "Linux"; break;
  case '4': echo "MacOS"; break;
  default: echo "ein anderes Betriebssystem"; break;
}
echo "\n";
