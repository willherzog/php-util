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

	static public function getCurrentTime(string $timezone = 'UTC'): DateTimeInterface
	{
		return new DateTimeImmutable('now', new DateTimeZone($timezone));
	}

	static public function getCurrentTimeString(string $format = DateTimeInterface::W3C): string
	{
		return self::getCurrentTime()->format($format);
	}
}
