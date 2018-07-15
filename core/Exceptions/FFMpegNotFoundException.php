<?php 

namespace FFMpegLib\Exceptions;

class FFMpegNotFoundException extends \Exception {
	public function __construct($message = null) {
		$localMessage = 'Please download ffmpeg from "https://www.ffmpeg.org/" and initialize it!';

		parent::__construct($message ?? $localMessage);
	}
}