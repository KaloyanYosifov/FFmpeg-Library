<?php 

namespace FFMpegLib\Interfaces;

interface CommandInterface {
	// Get interface arguments
	public function getCommandArgs();

	// Implement logic for the contract made with the interface
	public function checkOutput($output);

	// Check if argument passed
	public function passed();

	// Check if argument passed
	public function failed();
}