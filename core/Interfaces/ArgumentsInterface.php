<?php 

namespace FFMpegLib\Interfaces;

interface ArgumentsInterface {
	public function getArgs();
	public function checkOutput($output);
}