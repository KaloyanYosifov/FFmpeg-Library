<?php 

namespace FFMpegLib\Util\Exceptions;

class WrongFormatException extends \Exception {
	public function __construct($format = '00:00:00') {
		parent::__construct("Wrong format entered!Please enter this format for time \"{$format}\"");
	}
}