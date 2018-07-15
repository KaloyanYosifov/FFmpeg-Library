<?php 

namespace FFMpegLib\Exceptions;

class FFMpegNotFoundException extends \Exception {
	public function __constructor($message = null) {
		$localMessage = 'Please download ffmpeg from "https://www.ffmpeg.org/" and initialize it!';

		parent::__constructor($message ?? $localMessage);
	}
}