<?php 

namespace FFMpegLib\Arguments;

use FFMpegLib\Interfaces\ArgumentsInterface;
use FFMpegLib\Exceptions\FFMpegNotFoundException;

class FFMpegChecker implements ArgumentsInterface {
	protected $args;
	protected $argumentPassed;

	public function __construct() {
		$this->args = [
			'ffmpeg -version 2>&1',
		];

		$this->$argumentPassed = false;
	}

	public function getArgs() {
		return implode(' ', $this->args);
	}

	public function checkOutput($output) {
		if (preg_match('~(Copyright).*?(FFmpeg)~', $output)) {
			throw new FFMpegNotFoundException();
		}

		$this->argumentPassed = true;
	}

	public function passed() {
		return $this->argumentPassed;
	}

	public function failed() {
		return $this->argumentPassed;
	}
}