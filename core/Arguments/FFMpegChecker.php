<?php 

namespace FFMpegLib\Arguments;

use FFMpegLib\Interfaces\ArgumentsInterface;
use FFMpegLib\Exceptions\FFMpegNotFoundException;

class FFMpegChecker implements ArgumentsInterface {
	protected $args;

	public function __construct() {
		$this->args = [
			'ffmpeg -version 2>&1',
		];
	}

	public function getArgs() {
		return implode(' ', $this->args);
	}

	public function checkOutput($output) {
		if (preg_match('~(Copyright).*?(FFmpeg)~', $output)) {
			throw new FFMpegNotFoundException();
		}
	}
}