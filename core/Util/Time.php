<?php 

namespace FFMpegLib\Util;

use FFMpegLib\Interfaces\TimeFormatInterface;
use FFMpegLib\Util\Exceptions\WrongFormatException;

class Time {
	protected $timeFormat;
	protected $time;

	/**
	 * Supported time formats currently are 00:00:00
	 * @param TimeFormatInterface $timeFormat
	 */
	protected function __construct(TimeFormatInterface $timeFormatObject = null, $timeFormat = '00:00:00') {
		if ($timeFormatObject) {
			$this->timeFormat = $timeFormatObject->getFormattedTime();
		} else {
			$this->timeFormat = $timeFormat;
		}
		$this->time = [];
		$this->initializeTime();
	}

	/**
	 * Create an instance of Time
	 * @param  TimeFormatInterface $timeFormat
	 * @return new Time
	 */
	public static function create(TimeFormatInterface $timeFormatObject) {
		return new static($timeFormatObject);
	}

	public static function createFromString($timeFormat = '00:00:00') {
		return new static(null, $timeFormat);
	}

	public function getSeconds() {
		return $this->time['seconds'];
	}

	public function getMinutes() {
		return $this->time['minutes'];
	}

	public function getHours() {
		return $this->time['hours'];
	}

	public function getTimeInSeconds() {
		return $this->getNormalizedTime();
	}

	public function getTimeInMinutes() {
		return $this->getNormalizedTime('minutes');
	}


	public function getFullTime() {
		return $this->timeFormat;
	}

	protected function getNormalizedTime($to = 'seconds') {
		if (!in_array($to, ['seconds', 'minutes'])) {
			return 0;
		}

		$hoursToInt = intval($this->time['hours']);
		$minutesToInt = intval($this->time['minutes']);
		$secondsToInt = intval($this->time['seconds']);

		$timeNormalized = 0;
		
		if ($hoursToInt) {
			if ($to === 'seconds') {
				$timeNormalized = $hoursToInt * 60 * 60;
			} else {
				$timeNormalized = $hoursToInt * 60;
			}
		}

		if ($minutesToInt) {
			if ($to === 'seconds') {
				$timeNormalized += $minutesToInt * 60;
			} else {
				$timeNormalized += $minutesToInt;
			}
		}

		if ($secondsToInt) {
			if ($to === 'seconds') {
				$timeNormalized += $secondsToInt;
			} else {
				$timeNormalized += $secondsToInt / 60;
			}
		}

		return $timeNormalized;
	}

	protected function initializeTime() {
		if (!preg_match('~:~', $this->getFullTime())) {
			throw new WrongFormatException();
		}

		$timeIndexing = [
			'hours',
			'minutes',
			'seconds',
		];

		$splittedTime = explode(':', $this->getFullTime());
		for($splittedTimeIndex = 0; $splittedTimeIndex < count($splittedTime); $splittedTimeIndex++) {
			if ($splittedTimeIndex >= 3) {
				break;
			}

			$timeIndexName = $timeIndexing[ $splittedTimeIndex ];

			//convert splittedTime
			$singleTime = intval(round($splittedTime[ $splittedTimeIndex ]));

			// Pad the time
			$singleTime = str_pad($singleTime, 2, '0', STR_PAD_LEFT);

			$this->time[ $timeIndexName ] = $singleTime;
		}
	}
}