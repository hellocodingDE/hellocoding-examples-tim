<?php
echo "Du nutzt die PHP Version: ".phpversion()."\n";
echo "Diese ist ".((version_compare(phpversion(), 7.0, ">=")) ? 'größer gleich' : 'kleiner')."als PHP7\n";
