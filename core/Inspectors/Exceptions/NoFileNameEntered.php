<?php 

namespace FFMpegLib\Inspectors\Exceptions;

class NoFileNameEntered extends \Exception {
	public function __construct() {
		$localMessage = 'No filename was entered to the constructor!';

		parent::__construct($localMessage);
	}
}