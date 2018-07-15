<?php 

namespace FFMpegLib\Commands;

use FFMpegLib\Interfaces\CommandInterface;
use FFMpegLib\Traits\Validation;
use FFMpegLib\Inspectors\VideoInspector;
use FFMpegLib\FileFinder\FileFinder;
use FFMpegLib\Util\Time;
use FFMpegLib\Convertors\FFmpegDurationConvertor;

class VideoDurationCommand implements CommandInterface {
	use Validation;

	protected $args;
	protected $validation;
	protected $time;

	public function __construct($videoFile = null, $directoryToSearch = __DIR__) {
		ffmpegInitialized();
		$this->validation = false;
		$this->time = false;

		// create an instance of inpsector
		$videoInspector = new VideoInspector($videoFile);

		// check if file is supported
		$videoInspector->checkFile();

		$videoFile = FileFinder::findFile($videoFile, $directoryToSearch);

		$this->args = [
			'ffmpeg',
			'-i ' . $videoFile,
			'2>&1 |',
			'grep Duration',
		];
	}

	public function getCommandArgs() {
		return implode(' ', $this->args);
	}

	public function checkOutput($output) {
		if (!$output) {
			$this->validation = false;
		}

		$this->time = Time::create(FFmpegDurationConvertor::extractDuration($output));
	}

	public function getDuration() {
		return $this->time;
	}
}