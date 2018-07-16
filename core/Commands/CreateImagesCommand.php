<?php 

namespace FFMpegLib\Commands;

use FFMpegLib\Interfaces\CommandInterface;
use FFMpegLib\Traits\Validation;
use FFMpegLib\Inspectors\VideoInspector;
use FFMpegLib\Util\Time;
use FFMpegLib\Commands\Exceptions\VideoLengthError;

class CreateImagesCommand implements CommandInterface {
	use Validation;

	protected $args;
	protected $validation;
	protected $imageFullPathName;
	protected $framesCreated;

	public function __construct
		(
		$videoFile = null,
		$imageFullPathName = '',
		$startPosition = '00:00:00', 
		$endPosition = '00:00:03',
		Time $videoDuration
		) {
		Initializer::isFFMpegInitialized();
		$this->validation = false;
		$this->imageFullPathName = formatImageNameFoFFMpeg($imageFullPathName);
		$endPositionTime = Time::createFromString($endPosition);
		
		$startPositionTime = Time::createFromString($startPosition);

		if ($startPositionTime->getTimeInSeconds() > $videoDuration->getTimeInSeconds()) {
			$startPosition = "00:00:00";
			$startPositionTime = Time::createFromString($startPosition);
		}

		if ($endPositionTime->getTimeInSeconds() > $videoDuration->getTimeInSeconds()) {
			throw new VideoLengthError($endPosition, $videoDuration->getFullTime());
		}

		// create an instance of inpsector
		$videoInspector = new VideoInspector($videoFile);

		// check if file is supported
		$videoInspector->checkFile();

		$secondsCombinedFromStartAndEnd = $endPositionTime->getSeconds() - $startPositionTime->getSeconds();

		$MAX_FRAMES = 25;
		$this->framesCreated = $MAX_FRAMES * $secondsCombinedFromStartAndEnd;

		$this->args = [
			'ffmpeg',
			'-ss ' . $startPosition,
			'-to ' . $endPosition,
			'-i ' . $videoFile,
			'-frames ' . $this->framesCreated,
			$this->imageFullPathName,
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

	public function framesCreated() {
		return $this->framesCreated;
	}
}