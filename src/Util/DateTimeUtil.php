<?php

namespace WHPHP\Util;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

/**
 * Utility methods for working with PHP DateTime classes and interfaces.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
final class DateTimeUtil
{
	private function __construct()
	{}

	/**
	 * Get the current time for the given timezone (UTC by default).
	 */
	static public function getCurrentTime(string $timezone = 'UTC'): DateTimeInterface
	{
		return new DateTimeImmutable('now', new DateTimeZone($timezone));
	}

	/**
	 * Get the current UTC time formatted as a string (W3C format by default).
	 *
	 * @uses `self::getCurrentTime()`
	 */
	static public function getCurrentTimeString(string $format = DateTimeInterface::W3C): string
	{
		return self::getCurrentTime()->format($format);
	}
}
