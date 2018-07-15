<?php 

namespace FFMpegLib\Commands\Exceptions;

class NotGifFileException extends \Exception {
	public function __construct($file = '') {
		parent::__construct('Please enter a file with gif extension not ' . $file);
	}
}