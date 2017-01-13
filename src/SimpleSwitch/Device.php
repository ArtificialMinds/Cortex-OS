<?php
namespace Cortex\SimpleSwitch;

use com\netbixx\WiringPiPHP\WiringPiPHP as WiringPi;
use ArtificialMinds\Neuron\NeuronTransmission;

class SimpleSwitch extends BaseDevice {

const GPIO_PIN = 17;

public function onPower() {
	$wiringPi = new WiringPi("gpio");
	$wiringPi->pinMode(self::GPIO_PIN, WiringPi::OUT);
	$wiringPi->digitalWrite(self::GPIO_PIN, WiringPi::OFF);
}

public function setup() {
	parent::setup();

	$wiringPi->addEventListener(self::GPIO_PIN,
		WiringPi::CHANGE, [$this, "update"]);
}

public function onNetworkUp() {
// Toggle the switch to indicate the network has just connected.
	for($i = 0; $i < 2; $i++) {
		$wiringPi->digitalWrite(self::GPIO_PIN, WiringPi::ON);
		usleep(500000);
		$wiringPi->digitalWrite(self::GPIO_PIN, WiringPi::OFF);
		usleep(500000);
	}
}

public function onNetworkDown() {

}

public function update(NeuronTransmission $data) {
	if($data->digital) {
		$wiringPi->digitalWrite(self::GPIO_PIN, WiringPi::ON);
	}
	else {
		$wiringPi->digitalWrite(self::GPIO_PIN, WiringPi::OFF);
	}
}

}#