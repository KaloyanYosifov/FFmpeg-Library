<?php 

namespace FFMpegLib\Inspectors\Exceptions;

class VideoNotSupported extends \Exception {
	public function __construct($filename = '') {
		$localMessage = "Video file not supported \"{$filename}\"!";

		parent::__construct($localMessage);
	}
}