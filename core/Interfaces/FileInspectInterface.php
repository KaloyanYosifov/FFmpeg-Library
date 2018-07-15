<?php 

namespace FFMpegLib\Interfaces;

interface FileInspectInterface {
	// Get file name of file
	public function getFile();

	// implement logic to check file
	public function checkFile();
}