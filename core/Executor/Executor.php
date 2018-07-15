<?php 

namespace FFMpegLib\Executor;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use FFMpegLib\Interfaces\ArgumentsInterface;

class Executor {
	/**
	 * Execute a command from the arguments interface
	 * @param  ArgumentsInterface $arguments. An instance of Arguments interface
	 * @return boolean
	 */
	public static function executeCommand(ArgumentsInterface $arguments) {
		$process = new Process($arguments->getArgs());
		
		try {
			$process->run();

			$output = $process->getOutput();

			$arguments->checkOutput($output);

			return true;
		} catch (ProcessFailedException $e) {
			return false;
		}
	}
}