<?php

namespace WHPHP\Util;

/**
 * Utility methods for working with strings.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
final class StringUtil
{
	private function __construct()
	{}

	/**
	 * Determines whether a string contains another string; wrapper for {@link mb_strpos()} which only returns TRUE or FALSE.
	 *
	 * Note that {@link str_contains()} should be used instead for machine language operations.
	 */
	static public function containsSingle(string $needle, string $haystack): bool
	{
		return mb_strpos($haystack, $needle) !== false;
	}

	/**
	 * @deprecated Use `self::containsAny()` or `self::containsAll()` instead
	 *
	 * Determines whether a string contains some or all of multiple strings.
	 *
	 * @param string[] $needles The strings to search for
	 * @param $haystack The string to search within
	 * @param $requireAll Whether all $needles must be present in $haystack
	 */
	static public function containsMultiple(array $needles, string $haystack, bool $requireAll = false): bool
	{
		if( $requireAll ) {
			return self::containsAll($needles, $haystack);
		} else {
			return self::containsAny($needles, $haystack);
		}
	}

	/**
	 * Determines whether a string haystack contains any of multiple string needles (using {@link mb_strpos()}).
	 */
	static public function containsAny(array $needles, string $haystack): bool
	{
		foreach( $needles as $needle ) {
			if( !is_string($needle) ) {
				continue;
			}

			if( mb_strpos($haystack, $needle) !== false ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Determines whether a string haystack contains all of multiple string needles (using {@link mb_strpos()}).
	 */
	static public function containsAll(array $needles, string $haystack): bool
	{
		foreach( $needles as $needle ) {
			if( !is_string($needle) ) {
				continue;
			}

			if( mb_strpos($haystack, $needle) === false ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Converts a floating point number to a string, ensuring that all (and only) excess leading and trailing zeroes have been stripped off.
	 */
	static public function convertFloatToString(float $float): string
	{
		$strNum = (string) $float;

		if( strpos($strNum, '.') ) {
			[$int, $frac] = explode('.', $strNum);
		} else {
			$int = $strNum;
			$frac = '0';
		}


		if( strlen($int) === 2 && $int[0] === '0' ) {
			$int = substr($int, 1, 1);
		}

		if( strlen($frac) === 2 && $frac[1] === '0' ) {
			$frac = substr($frac, 0, 1);
		}

		return sprintf('%s.%s', $int, $frac);
	}

	/**
	 * Converts "True"|"TRUE"|"true"|"False"|"FALSE"|"false" to the appropriate boolean equivalent. All other strings are returned as-is.
	 */
	static public function convertEquivalentStringToBoolean(string $str): bool|string
	{
		switch( mb_strtolower($str) ) {
			case 'true':
				return true;
			case 'false':
				return false;
			default:
				return $str;
		}
	}

	/**
	 * Converts a string for which {@link is_numeric()} returns TRUE to an integer or float based on absence or presence of a period character, respectively.
	 */
	static public function convertStringToNumber(string $str): int|float
	{
		return str_contains($str, '.') ? (float) $str : (int) $str;
	}

	/**
	 * @param string $str The string to be converted
	 * @param bool $preserveDoubleUnderscores If TRUE, double underscores ("__") are not converted to dashes; defaults to FALSE
	 */
	static public function convertUnderscoresToDashes(string $str, bool $preserveDoubleUnderscores = false)
	{
		if( str_contains($str, '_') ) {
			if( $preserveDoubleUnderscores ) {
				$str = str_replace(['__','_','++'], ['++','-','__'], $str);
			} else {
				$str = str_replace('_', '-', $str);
			}
		}

		return $str;
	}

	/**
	 * Remove all space, tab, line feed, carriage return and vertical tab characters from a string value.
	 */
	static public function stripWhiteSpace(string $str): string
	{
		return str_replace([' ', "\t", "\n", "\r", "\v"], '', $str);
	}
}
