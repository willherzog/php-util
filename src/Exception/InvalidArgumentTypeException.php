<?php

namespace WHPHP\Exception;

/**
 * An invalid argument exception with a type-based dynamic message.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
class InvalidArgumentTypeException extends \InvalidArgumentException
{
	/**
	 * @param mixed $value The value with an invalid type
	 * @param string|string[] $requiredType The expected type or types
	 */
	public function __construct(mixed $value, string|array $requiredType, int $code = 0, \Throwable|null $previous = null)
	{
		if( $requiredType === '' || $requiredType === [] ) {
			throw new \LogicException('$requiredType must not be empty.');
		}

		$valueType = get_debug_type($value);
		$quotify = fn($type) => '"'.$type.'"';

		if( is_array($requiredType) ) {
			$requiredTypes = array_values($requiredType); // ensure the array is zero-indexed

			if( count($requiredTypes) > 1 ) {
				array_walk($requiredTypes, $quotify);

				$requiredType = implode(', ', array_slice($requiredTypes, 0, -1));
				$requiredType .= ' or ' . $requiredTypes[array_key_last($requiredTypes)];
			} else {
				$requiredType = $quotify($requiredTypes[0]); // don't use multi-type message if there's actually only one type
			}
		} else {
			$requiredType = $quotify($requiredType);
		}

		$message = sprintf('Expected an argument of type %s but got a(n) %s instead.', $requiredType, $quotify($valueType));

		parent::__construct($message, $code, $previous);
	}
}
