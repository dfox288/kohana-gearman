<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Gearman Queue Manager
 *
 * @package    Gearman
 * @author     Kiall Mac Innes
 * @copyright  (c) 2010 Kiall Mac Innes
 * @license    http://kohanaframework.org/license
 */
class Gearman_Worker_PECL extends Gearman_Worker
{
	protected $worker;

	protected function __construct(array $config)
	{
		parent::__construct($config);

		$this->worker = new GearmanWorker();

		if (is_string($this->config['servers']))
		{
			$this->worker->addServers($this->config['servers']);
		}
		else
		{
			foreach ($this->config['servers'] as $server)
			{
				$this->worker->addServer($server[0], $server[1]);
			}
		}

		// Create a list of available task methods
		$tasks = $this->_list_tasks(Kohana::list_files('classes/Gearman/Task'));

		foreach ($tasks AS $task => $opts)
		{
			$instance = new $task;
			$callback = array($instance, 'work');

			$timeout = (isset($opts['timeout']) ? $opts['timeout'] : $this->config['timeout']);
			$this->worker->addFunction($instance->function_name(), $callback, NULL, $timeout);
		}

	}

	protected function _work()
	{
		while($this->worker->work());
	}

	/**
	 * Compiles a list of available Gearman tasks
	 *
	 * @param  array Directory structure of tasks
	 * @return array Array of [$task_classe => $opts]
	 */
	protected function _list_tasks(array $files)
	{
		$es = array();

		foreach ($files AS $file => $path)
		{
			$class = str_replace(
				array('classes/', '/', '.php'),
				array('', '_', ''),
				$file
			);

			// Invalid file name that doesn't map to class
			if (!class_exists($class))
			{
				continue;
			}

			$inspector = new ReflectionClass($class);
			$default_properties = $inspector->getDefaultProperties();

			$opts = array();
			if (isset($default_properties['options']))
			{
				$opts = $default_properties['options'];
			}

			// TODO: implement ReflectionClass::getMethods()
			//  Filter out private methods; use public ones as 'class::method'
			//  and map those to addFunction()'s $function_name

			if (is_array($path) AND count($path))
			{
				$task = $this->_list_tasks($path);

				if ($task)
				{
					$es = array_merge($es, $task);
				}
			}
			else
			{
				$es[$class] = $opts;
			}
		}

		return $es;
	}
}
