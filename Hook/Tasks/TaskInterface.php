<?php

namespace App\HookPipe\Hook\Tasks;

/**
*	@package App\Hookpipe
*/
interface TaskInterface {

	// smoke the task means you run the task
	public function smoke(); 

}