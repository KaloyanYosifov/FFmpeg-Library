<?php 

use FFMpegLib\Initializer;

function ffmpegInitialized() {
	return Initializer::isFFMpegInitialized();
}

?>