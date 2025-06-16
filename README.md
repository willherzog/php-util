# php-util
 Some general PHP utilities:
 * `StringUtil`, `ArrayUtil`, `UrlUtil`, `DateTimeUtil` and `IntlDateUtil` with various static utility methods (see their listed methods below; aside from the methods of `IntlDateUtil`, all of them also have inline documentation)
 * `InvalidArgumentTypeException`, which generates an automatic, type-based error message
 * `GenericBag` interface, which is similar to—but more generic than—Symfony’s `ParameterBag` class

StringUtil
----------

Include path: `WHPHP\Util\StringUtil`

Static Utility Methods:

* `containsSingle()` – Multibyte-friendly alternative to the PHP native function _`str_contains()`_ (the native function should be preferred whenever the input string contains no multibyte characters).
* `containsAny()` – Determine whether a string haystack contains any of multiple string needles (multibute-friendly).
* `containsAll()` – Determine whether a string haystack contains all of multiple string needles (multibute-friendly).
* `convertFloatToString()` – Convert a floating point number to a string, ensuring that all (and only) excess leading and trailing zeroes have been stripped off.
* `convertEquivalentStringToBoolean()` – Convert "True"|"TRUE"|"true"|"False"|"FALSE"|"false" to the appropriate boolean equivalent. All other strings are returned as-is.
* `convertStringToNumber()` – Convert a string for which _`is_numeric()`_ returns `true` to an integer or float (based on absence or presence of a period character, respectively).
* `convertUnderscoresToDashes()` – Convert a string in _snake_ case (e.g. "convert_underscores_to_dashes") to _kebab_ case (e.g. "convert-underscores-to-dashes"). The effect is similar to the `->kebab()` method of the concrete classes of the Symfony String component, except without the ability to act on arbitrary input strings (i.e. ones not already in snake case). This method can also optionally preserve any _double_ underscores by setting its second argument to `true`.
* `stripWhiteSpace()` – Remove all space, tab, line feed, carriage return and vertical tab characters from a string value.

ArrayUtil
---------

Include path: `WHPHP\Util\ArrayUtil`

Static Utility Methods:

* `isIndexed()` – Determine whether the input array is indexed and not associative (i.e. all keys are integers). Note that the PHP 8.1+ native function _`array_is_list()`_ is a preferred alternative, *except* if the keys may not be 0-based and/or consecutive (in other words, this method is less strict).
* `isAssociative()` – Determine whether the input array is associative and not indexed (i.e. all keys are strings).
* `isMultiDimensional()` – Determine whether the input array is multi-dimensional (i.e. all elements are themselves arrays).
* `addValue()` – Add a value to an array by reference—but only if not already present.
* `removeValue()` – Remove a value from an array by reference (if present).
* `flatten()` – Reduce an array with only a single value to just that value (this method is a more specific alternative to the PHP native function _`array_reduce()`_).
* `hasKeys()` – Check if any number of keys are present in an array (with some optional behavioral adjustments).
* `getNextAvailableIndex()` – Find the next-lowest *unused* array index, beginning with the given integer.

UrlUtil
-------

Include path: `WHPHP\Util\UrlUtil`

Static Utility Methods:

* `appendUrlQueryParams()` – Uses the PHP native function _`http_build_query()`_ to convert an array to a valid URL query string and safely appends it to (and then returns) the input string.
* `formatForDisplay()` – Remove URL scheme and—if there are no path, query or fragment portions—remove the ending forward slash.

DateTimeUtil
------------

Include path: `WHPHP\Util\DateTimeUtil`

Static Utility Methods:

* `getCurrentTime()` – Get the current time for the given timezone.
* `getCurrentTimeString()` – Get the current UTC time formatted as a string.

IntlDateUtil
------------

Include path: `WHPHP\Util\IntlDateUtil`

Static Utility Methods:

All of these format a `DateTime`/`DateTimeImmutable` object using the PHP `Intl` extension.

* `getFormattedDateAndTime()`
* `getFormattedDate()`
* `getFormattedTime()`
