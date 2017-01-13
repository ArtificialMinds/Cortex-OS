<?php
namespace Cortex;

define("AUTOLOAD_FILEPATH", __DIR__ . "/vendor/autoload.php");

if(!file_exists(AUTOLOAD_FILEPATH)) {
	echo "Composer is not installed, please see https://github.com/ArtificialMinds/Cortex-OS/wiki" . PHP_EOL;
	exit(1);
}

if(empty($argv[1])) {
	echo "Name of device must be first argument, none passed." . PHP_EOL;
	exit(1);
}

$deviceName = $argv[1];