<?php 

namespace FFMpegLib\Arguments;

use FFMpegLib\Intefaces\ArgumentsInterface;

class FFMpegChecker implements ArgumentsInterface {
	protected $args;

	public function __constructor() {
		$this->args = [
			'ffmpeg -version',
		];
	}

	public function getArgs() {
		return implode(' ', $this->args);
	}
}