<?php
if (function_exists('shell_exec') and !empty(shell_exec('echo foobar'))) {
    echo "shell_exec ist aktiviert\n";
} else {
    die("shell_exec ist deaktiviert\n");
}

echo shell_exec('ls');
