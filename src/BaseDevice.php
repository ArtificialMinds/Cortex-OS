<?php
namespace Cortex;

use ArtificialMinds\Neuron\NeuronTransmission;

abstract class BaseDevice {

/**
 * Called as soon as the OS powers up, before setup().
 */
public abstract function onPower();

/**
 * Called every time the network interface is connected. This will never be
 * called before onPower or setup.
 */
public abstract function onNetworkUp();

/**
 * Called every time the network interface is disconnected. This will also be
 * called before a reboot or shutdown.
 */
public abstract function onNetworkDown();

/**
 * Called once, after OS is fully booted. Any devices or OS interactions should
 * be initiated here.
 *
 * Any construction of your own classes should be performed after calling
 * parent::setup().
 */
public function setup() {
	if(!Indentifier::isRegistered()) {
		Identifier::requestId();
	}
}

/**
 * This function will be called when the device is interacted with. It will not be called without having callbacks assigned in setup().
 */
public abstract function update(NeuronTransmission $data);

}#