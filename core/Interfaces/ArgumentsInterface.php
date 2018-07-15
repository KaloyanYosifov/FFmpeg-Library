<?php 

namespace FFMpegLib\Interfaces;

interface ArgumentsInterface {
	public function getArgs();
	public function checkOutput($output);
	public function passed();
	public function failed();
}