<?php 

namespace FFMpegLib\Commands\Exceptions;

class VideoLengthError extends \Exception {
	public function __construct($passedTime = '', $videoTime = '') {
		parent::__construct('Passed length ' . $passedTime . ' is longer than video\'s ' . $videoTime);
	}
}