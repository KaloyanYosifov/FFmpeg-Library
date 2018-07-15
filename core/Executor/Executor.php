<?php 

namespace FFMpegLib\Executor;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use FFMpegLib\Interface\ArgumentsInterface;

class Executor {
	public static function executeCommand(ArgumentsInterface $arguments) {
		dd($arguments->getArgs());
	}
}