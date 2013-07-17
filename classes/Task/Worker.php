<?php

/**
 * Gearman Worker Minion Task
 *
 * Run with `./path/to/minion --task=worker`
 */
class Task_Worker extends Minion_Task
{
	protected $_options = array();

	/**
	 * Starts up
	 *
	 * @return null
	 */
	protected function _execute(array $params)
	{
		ob_end_flush();

		$worker = Gearman_Worker::instance('default');

		while ($worker->work());
	}
}
