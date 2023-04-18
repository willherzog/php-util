<?php

namespace WHPHP\Exception;

/**
 * An invalid argument exception with a type-based dynamic message.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
class InvalidArgumentTypeException extends \InvalidArgumentException
{
	public function __construct(mixed $value, string $requiredType, int $code = 0)
	{
		$valueType = \get_debug_type($value);

		parent::__construct(sprintf('Expected an argument of type "%s", got a(n) "%s" instead.', $requiredType, $valueType), $code);
	}
}
