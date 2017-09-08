<?php

namespace App\HookPipe\Hook\Capsules;

/**
 * @package App\Hookpipe
 * Class for capsule interface.
 */
interface CapsuleInterface {
	/**
	 * capsules can be smoked which means 
	 * it will smoke all of it's tasks. 
	 */
	public function smoke();
}