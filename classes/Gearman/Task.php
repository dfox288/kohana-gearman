<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Gearman Queue Manager
 *
 * @package    Gearman
 * @author     Kiall Mac Innes
 * @copyright  (c) 2010 Kiall Mac Innes
 * @license    http://kohanaframework.org/license
 */

abstract class Gearman_Task
{
	protected $complete = FALSE;
	protected $success = FALSE;
	protected $warning = FALSE;
	protected $failed = FALSE;
	protected $exception = FALSE;

	protected $job;
	protected $workload = NULL;

	protected $max_retries = 0;
	protected $retry_count = 0;

	protected $log;

	public static function factory($class)
	{
		$class = 'Gearman_Task_' . $class;
		return new $class;
	}

	public function __construct()
	{
		$this->log = Kohana_Log::instance();
	}

	public function work($job)
	{
		$this->job = $job;
		$this->workload($job->workload());

		try
		{
			$result = $this->_work();
		}
		catch (Exception $e)
		{
			// Unknown excpetions are caught and sent in full.
			$this->send_warning($e);
			$this->send_fail();

			// NOTE:
			// $gmworker->sendException($e) seems to be broken in the current gearman server? (Fixed in libgearman 0.13 i believe)
		}
	}

	public function workload($workload = FALSE)
	{
		if ($workload)
		{
			$this->workload = $workload;

			return TRUE;
		}
		else
		{
			return $this->workload;
		}
	}

	public function function_name()
	{
		return strtolower(Kohana::$environment.'_'.get_class($this));
	}


	// Send Returns - PECL Only at the mo :|
	protected function send_complete($content = NULL)
	{
		$this->job->sendComplete($content);

		$this->log->add(Log::INFO, 'GEARMAN: :function_name task completed successfully',
			array(
				':function_name' => $this->function_name()
			));

		return $this;
	}

	protected function send_warning($content = NULL)
	{
		$this->job->sendWarning($content);

		$this->log->add(Log::ERROR, 'GEARMAN: :function_name emitted a warning',
			array(
				':function_name' => $this->function_name()
			));

		return $this;
	}

	protected function send_fail()
	{
		$this->job->sendFail();

		$this->log->add(Log::ERROR, 'GEARMAN: :function_name task NOT completed successfully - Failed',
			array(
				':function_name' => $this->function_name()
			));

		return $this;
	}

	protected function send_exception($content = NULL)
	{
		$this->job->sendException($content);

		$this->log->add(Log::ERROR, 'GEARMAN: :function_name emitted an exception',
			array(
				':function_name' => $this->function_name()
			));

		return $this;
	}

	protected function send_status($numerator, $denominator)
	{
		$this->job->sendStatus($numerator, $denominator);

		$this->log->add(Log::DEBUG, 'GEARMAN: :function_name emitted a status update (:numerator/:denominator)',
			array(
				':function_name' => $this->function_name(),
				':numerator'     => $numerator,
				':denominator'   => $denominator,
			));

		return $this;
	}

	// Handle Returns
	public function handle_success($result)
	{
		$this->complete = TRUE;
		$this->success = TRUE;

		$this->log->add(Log::INFO, 'GEARMAN: :function_name task completed successfully',
			array(
				':function_name' => $this->function_name()
			));

		$this->on_success($result);
	}

	protected function on_success($result)
	{

	}

	public function handle_warning($result)
	{
		$this->warning = TRUE;

		$this->log->add(Log::ERROR, 'GEARMAN: :function_name emitted a warning',
			array(
				':function_name' => $this->function_name()
			));

		$this->on_warning($result);
	}

	protected function on_warning($result)
	{

	}

	public function handle_fail()
	{
		$this->complete = TRUE;
		$this->failed = TRUE;

		$this->log->add(Log::ERROR, 'GEARMAN: :function_name task NOT completed successfully - Failed',
			array(
				':function_name' => $this->function_name()
			));

		$this->on_fail();
	}

	protected function on_fail()
	{

	}

	public function handle_exception($result)
	{
		$this->exception = TRUE;

		$this->log->add(Log::ERROR, 'GEARMAN: :function_name emitted an exception',
			array(
				':function_name' => $this->function_name()
			));

		$this->on_exception($result);
	}

	protected function on_exception($result)
	{

	}

	public function handle_status($numerator, $denominator)
	{
		$this->log->add(Log::DEBUG, 'GEARMAN: :function_name emitted a status update (:numerator/:denominator)',
			array(
				':function_name' => $this->function_name(),
				':numerator'     => $numerator,
				':denominator'   => $denominator,
			));

		$this->on_status($numerator, $denominator);
	}

	protected function on_status($numerator, $denominator)
	{

	}

	public function handle_data($result)
	{
		$this->log->add(Log::DEBUG, 'GEARMAN: :function_name emitted a data update',
			array(
				':function_name' => $this->function_name()
			));

		$this->on_data($result);
	}

	protected function on_data($result)
	{

	}
}
