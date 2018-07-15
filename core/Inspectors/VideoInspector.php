<?php 

namespace FFMpegLib\Inspectors;

use FFMpegLib\Interfaces\FileInspectInterface;
use FFMpegLib\Inspectors\Exceptions\VideoNotSupported;
use FFMpegLib\Inspectors\Exceptions\NoFileNameEntered;

class VideoInspector implements FileInspectInterface {
	protected $fileName;
	protected $extensions;

	public function __construct($fileName) {
		$this->populateExtensions();

		$this->fileName = $fileName;
	}

	public function getFile() {
		return $this->fileName;
	}

	public function checkFile() {
		if (!$this->fileName) {
			throw new NoFileNameEntered();
		}

		$fileExtension = pathinfo($this->fileName, PATHINFO_EXTENSION);

		if (!in_array($fileExtension, $this->extensions)) {
			throw new VideoNotSupported($this->fileName);
		}

		return true;
	}

	protected function populateExtensions() {
		$this->extensions = [
			'mp4',
			'webm',
			'mov',
			'mkv',
			'flv',
			'ogv',
			'ogg',
			'drc',
			'wmv',
			'yuv',
			'm4p',
			'mpg',
			'mpeg',
			'mp2',
			'm2v',
			'm4v',
			'3gp',
			'3g2',
		];
	} 
}