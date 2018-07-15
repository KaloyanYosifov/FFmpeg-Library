<?php 

namespace FFMpegLib\Convertors;

use FFMpegLib\Interfaces\TimeFormatInterface;

class FFmpegDurationConvertor implements TimeFormatInterface {
	protected $ffmpegOutput;
	protected $formattedTime;

	public function __construct($ffmpegOutput = null) {
		$this->ffmpegOutput = $ffmpegOutput;
	}

	// Extract Duration Time from FFmpeg
	public static function extractDuration($output = null) {
		if (!$output) {
			return false;
		}
		
		$output = trim($output);

		return (new static($output))->extractTime();
	}

	public function getFormattedTime () {
		return $this->formattedTime;
	}

	protected function extractTime() {
		if (!preg_match('~^Duration~i', $this->ffmpegOutput)) {
			return false;
		}

		$this->formattedTime = explode(',', $this->ffmpegOutput)[0];
		$this->formattedTime = trim(preg_replace('~Duration:?~i', '', $this->formattedTime));

		return $this;
	}
}