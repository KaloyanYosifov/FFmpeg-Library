<?php 

namespace FFMpegLib\Commands;

use FFMpegLib\Interfaces\CommandInterface;
use FFMpegLib\Traits\Validation;
use FFMpegLib\Commands\Exceptions\NotGifFileException;

class GifCommand implements CommandInterface {
	use Validation;

	protected $args;
	protected $validation;

	public function __construct($imagesFirstName = 'image%d.png', $outputGifFile = 'video.gif') {
		ffmpegInitialized();
		
		if (!preg_match('~\.gif$~', $outputGifFile)) {
			throw new NotGifFileException($outputGifFile);
		}

		$this->validation = false;
		$imagesFirstName = formatImageNameFoFFMpeg($imagesFirstName);

		$this->args = [
			'ffmpeg',
			'-i ' . $imagesFirstName,
			$outputGifFile,
			'2>&1',
		];
	}

	public function getCommandArgs() {
		return implode(' ', $this->args);
	}

	public function checkOutput($output) {
		if (!$output) {
			$this->validation = false;
		}

		$this->validation = true;
	}
}