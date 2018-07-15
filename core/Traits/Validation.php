<?php 

namespace FFMpegLib\Traits;

/*
	This trait is used for interfaces which use passed and failed function
 */

trait Validation {
	public function passed() {
		return $this->validation;
	}

	public function failed() {
		return $this->validation;
	}
}