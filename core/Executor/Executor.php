<?php 

namespace FFMpegLib\Executor;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use FFMpegLib\Interfaces\CommandInterface;

class Executor {
	/**
	 * Execute a command from the arguments interface
	 * @param  CommandInterface $arguments. An instance of Arguments interface
	 * @return boolean
	 */
	public static function executeCommand(CommandInterface $arguments) {
		$process = new Process($arguments->getCommandArgs());
		
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