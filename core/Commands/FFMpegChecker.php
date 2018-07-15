<?php 

namespace FFMpegLib\Commands;

use FFMpegLib\Interfaces\CommandInterface;
use FFMpegLib\Exceptions\FFMpegNotFoundException;
use FFMpegLib\Traits\Validation;

class FFMpegChecker implements CommandInterface {
	use Validation;
	
	protected $args;
	protected $validation;

	public function __construct($local = false) {
		if (!$local) {
			ffmpegInitialized();
		}
		
		$this->args = [
			'ffmpeg -version 2>&1',
		];

		$this->validation = false;
	}

	public function getCommandArgs() {
		return implode(' ', $this->args);
	}

	public function checkOutput($output) {
		if (!preg_match('~(Copyright).*?(FFmpeg)~', $output)) {
			throw new FFMpegNotFoundException();
		}

		$this->validation = true;
	}
}