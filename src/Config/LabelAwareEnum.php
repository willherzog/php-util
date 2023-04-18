<?php

namespace WHPHP\Config;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
interface LabelAwareEnum
{
	public function getLabel(): string;
}
