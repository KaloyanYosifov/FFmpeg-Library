<?php 

namespace FFMpegLib\Exception;

class FFMpegNotInitialized extends \Exception {
	public function __construct($message = null) {
		$localMessage = 'FFMpeg Not initialized!Have you called "Initializer::initializeFFMpeg()" ?';

		parent::__construct();
	}
}