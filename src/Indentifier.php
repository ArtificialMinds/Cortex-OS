<?php
namespace Cortex;

use ArtificialMinds\Neuron\Auth\Registration;

class Identifier {

const CORTEX_ID_FILEPATH = "/var/cortex/cortex-id";

public static function isRegistered():bool {
	return is_file(self::CORTEX_ID_FILEPATH);
}

public static function getId():string {
	if(!is_file(self::CORTEX_ID_FILEPATH)) {
		throw new CortexException(
			"Cortex ID not found - have you registered this device?");
	}

	return file_get_contents(self::CORTEX_ID_FILEPATH);
}

public static function requestId():bool {
	$uuid = Registration::registerDevice();
	file_put_contents(self::CORTEX_ID_FILEPATH, $uuid);
}

}#