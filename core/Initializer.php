<?php 

namespace FFMpegLib;

use FFMpegLib\Executor\Executor;
use FFMpegLib\Commands\FFMpegChecker;
use FFMpegLib\Exceptions\FFMpegNotInitialized;

class Initializer {
	protected static $ffmpegInitialized = false;

	public static function initializeFFMpeg() {
		if (!static::$ffmpegInitialized) {
			$ffmpegChecker = new FFMpegChecker(true);
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