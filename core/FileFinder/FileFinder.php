<?php 

namespace FFMpegLib\FileFinder;

use Symfony\Component\Finder\Finder;

class FileFinder {
	protected $finder;

	protected function __construct() {
		$this->finder = new Finder();
	}

	public static function create() {
		return new static();
	}

	/**
	 * Find a file defering if it is a absolute path or not
	 * @param $fileName
	 * @return absolutePathToFile
	 */
	public static function findFile($fileName = null, $directoryToSearch = __DIR__) {
		if (!$fileName || !$directoryToSearch) {
			return false;
		}


		if (static::isAbsolute($fileName)) {
			return $fileName;
		}
		$localFinder = new static();
		$localFinder->finder->name($fileName)->files()->in($directoryToSearch);

		$fileAbsolutePath = '';

		foreach ($localFinder->finder as $file) {
			$fileAbsolutePath = $file->getRealPath();
		}

		return $fileAbsolutePath;
	}

	/**
	 * Determine if the fileName is absolute or not
	 * @param $fileName
	 * @return boolean
	 */
	public static function isAbsolute($fileName = null) {
		if (!$fileName) {
			return false;
		}

		return preg_match('~(\/|\\\)~', $fileName);
	}
}