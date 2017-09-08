<?php
namespace App\HookPipe\Hook\Capsules;

use App\HookPipe\Hook\Tasks\BasicTask;

/**
* @todo documentation
* @todo turn array into a collection
*/
class Capsule extends BasicCapsule
{

	/**
	 * { function_description }
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * for setting all the tasks at once
	 *
	 * @param      string  $value  The value
	 */
	public function set(array $tasksToBe)
	{
		$this->tasks = $tasksToBe;
	}

	/**
	 * push a task inside to a capsule
	 *
	 * @param      \App\HookPipe\Hook\Tasks\Webhook  $task   The task
	 */
	public function push(BasicTask $task)
	{
		$this->tasks[] = $task;
	}

	/**
	 * { function_description }
	 */
	public function smoke()
	{
		$tasks = $this->tasks;

		foreach ($tasks as $task) {
			$task->smoke();
		}
	}

}