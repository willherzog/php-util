<?php

namespace WHPHP\Util;

/**
 * Utility methods for working with arrays.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
final class ArrayUtil
{
	private function __construct()
	{}

	/**
	 * Determines whether the given array is indexed and not associative (i.e. all keys are integers).
	 *
	 * The PHP 8.1+ native function array_is_list() is a preferred alternative, *except* if the keys may not be 0-based and/or consecutive.
	 */
	static public function isIndexed (array $array): bool
	{
		foreach( array_keys($array) as $key ) {
			if( !is_int($key) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Determines whether the given array is associative and not indexed (i.e. all keys are strings).
	 */
	static public function isAssociative (array $array): bool
	{
		foreach( array_keys($array) as $key ) {
			if( !is_string($key) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Determines whether the given array is multi-dimensional (i.e. all elements are themselves arrays).
	 */
	static public function isMultiDimensional (array $array): bool
	{
		foreach( $array as $element ) {
			if( !is_array($element) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Adds a value to an array by reference if not already present.
	 *
	 * @return Whether $value was added to $array
	 */
	static public function addValue (array &$array, $value): bool
	{
		if( !in_array($value, $array, true) ) {
			$array[] = $value;

			return true;
		}

		return false;
	}

	/**
	 * Removes a value from an array by reference if present.
	 *
	 * @return Whether $array contained $value
	 */
	static public function removeValue (array &$array, $value): bool
	{
		$key = array_search($value, $array, true);

		if( $key !== false ) {
			unset($array[$key]);

			return true;
		}

		return false;
	}

	/**
	 * Reduces an array with only a single value to just that value.
	 *
	 * @param $array The array to flatten
	 * @param $recursively Whether to call this method recursively if $array is multi-dimensional
	 *
	 * @return The single value, or the unmodified array if it contains more than one value
	 */
	static public function flatten (array $array, bool $recursively = false): mixed
	{
		if( count($array) === 1 ) {
			$output = array_shift($array);

			if( $recursively && is_array($output) ) {
				return self::flatten($output, true);
			} else {
				return $output;
			}
		}

		return $array;
	}

	/**
	 * Checks if any number of keys are present in an array.
	 *
	 * @uses self::removeValue()
	 *
	 * @param $array The array to be checked
	 * @param string[] $keys Non-associative array of keys
	 * @param $requireAll Whether all $keys must be present in $array (if more than one)
	 * @param $requireOnly Whether all keys of $array must be present in $keys
	 * @param $mustNotBeEmpty Whether all values of $array must be non-empty and non-null
	 *
	 * @return Whether or not the key(s) were found.
	 */
	static public function hasKeys (array $array, array $keys, bool $requireAll = true, bool $requireOnly = false, bool $mustNotBeEmpty = false): bool {
		$matchFound = false;

		foreach( $array as $key => $value ) {
			if( self::removeValue($keys, $key) ) {
				$matchFound = true;

				if( $mustNotBeEmpty && empty($value) && $value !== false ) {
					return false;
				}
			} elseif( $requireOnly ) {
				return false;
			}
		}

		if( $requireAll ) {
			return empty($keys);
		} else {
			return $matchFound;
		}
	}
}
