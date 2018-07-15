<?php 

use FFMpegLib\Initializer;

function ffmpegInitialized() {
	return Initializer::isFFMpegInitialized();
}

function formatImageNameFoFFMpeg($imageFileName = '') {
	if (!$imageFileName) {
		return $imageFileName;
	}

	$imageBaseDir = pathinfo($imageFileName, PATHINFO_DIRNAME);
	$imageName = pathinfo($imageFileName, PATHINFO_FILENAME);
	$imageExtension = pathinfo($imageFileName, PATHINFO_EXTENSION);

	return $imageBaseDir . DIRECTORY_SEPARATOR . $imageName . '%d.' . $imageExtension;
}

?>