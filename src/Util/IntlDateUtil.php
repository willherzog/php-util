<?php

namespace WHPHP\Util;

use DateTimeInterface;
use IntlDateFormatter;
use UnexpectedValueException;

/**
 * Methods for formatting a DateTime object using the PHP Intl extension.
 *
 * Note that the locale for the Intl extension is set with {@link Locale::setDefault()}.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
class IntlDateUtil
{
	final private function __construct()
	{}

	static public function getFormattedDateAndTime(DateTimeInterface $dateTime, string $type): string
	{
		if( !class_exists(IntlDateFormatter::class, false) ) {
			throw new \LogicException('The PHP Intl extension must be installed/enabled to use this class\'s methods.');
		}

		try {
			$dateTimeType = match($type) {
				'full' => IntlDateFormatter::FULL,
				'long' => IntlDateFormatter::LONG,
				'medium' => IntlDateFormatter::MEDIUM,
				'short' => IntlDateFormatter::SHORT
			};
		} catch( \UnhandledMatchError $e ) {
			throw new UnexpectedValueException('The $type argument must be one of full, long, medium or short.');
		}

		$formatter = new IntlDateFormatter(\Locale::getDefault(), $dateTimeType, $dateTimeType);

		return $formatter->format($dateTime);
	}

	static public function getFormattedDate(DateTimeInterface $dateTime, string $type, bool $relative = false): string
	{
		if( !class_exists(IntlDateFormatter::class, false) ) {
			throw new \LogicException('The PHP Intl extension must be installed/enabled to use this class\'s methods.');
		}

		try {
			$dateType = match($type) {
				'full' => $relative ? IntlDateFormatter::RELATIVE_FULL : IntlDateFormatter::FULL,
				'long' => $relative ? IntlDateFormatter::RELATIVE_LONG : IntlDateFormatter::LONG,
				'medium' => $relative ? IntlDateFormatter::RELATIVE_MEDIUM : IntlDateFormatter::MEDIUM,
				'short' => $relative ? IntlDateFormatter::RELATIVE_SHORT : IntlDateFormatter::SHORT
			};
		} catch( \UnhandledMatchError $e ) {
			throw new UnexpectedValueException('The $type argument must be one of full, long, medium or short.');
		}

		$formatter = new IntlDateFormatter(\Locale::getDefault(), $dateType, IntlDateFormatter::NONE);

		return $formatter->format($dateTime);
	}

	static public function getFormattedTime(DateTimeInterface $dateTime, string $type): string
	{
		if( !class_exists(IntlDateFormatter::class, false) ) {
			throw new \LogicException('The PHP Intl extension must be installed/enabled to use this class\'s methods.');
		}

		try {
			$timeType = match($type) {
				'full' => IntlDateFormatter::FULL,
				'long' => IntlDateFormatter::LONG,
				'medium' => IntlDateFormatter::MEDIUM,
				'short' => IntlDateFormatter::SHORT
			};
		} catch( \UnhandledMatchError $e ) {
			throw new UnexpectedValueException('The $type argument must be one of full, long, medium or short.');
		}

		$formatter = new IntlDateFormatter(\Locale::getDefault(), IntlDateFormatter::NONE, $timeType);

		return $formatter->format($dateTime);
	}
}
