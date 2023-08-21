<?php

namespace WHPHP\Config;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
trait EnumValuesTrait
{
	/**
	 * Shortcut method: retrieve all values for a backed enum as an indexed array.
	 */
	static public function getValues(): array
	{
		$values = [];

		foreach( static::cases() as $case ) {
			$values[] = $case->value;
		}

		return $values;
	}
}
