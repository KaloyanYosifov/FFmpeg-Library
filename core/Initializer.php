<?php 

namespace FFMpegLib;

use FFMpegLib\Executor\Executor;
use FFMpegLib\Arguments\FFMpegChecker;
use FFMpegLib\Exceptions\FFMpegNotInitialized;

class Initializer {
	protected static $ffmpegInitialized = false;

	public static function initializeFFMpeg() {
		if (!static::$ffmpegInitialized) {
			$ffmpegChecker = new FFMpegChecker();
			Executor::executeCommand($ffmpegChecker);

			static::$ffmpegInitialized = $ffmpegChecker->passed();
		}
	}

	public static function isFFMpegInitialized() {
		if (!static::$ffmpegInitialized) {
			throw new FFMpegNotInitialized();
		}
	}
}