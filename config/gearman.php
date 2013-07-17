<?php

return array(
	'worker' => array(
		'default' => array(
			'driver' => 'PECL',
			// Comma-separated list, format host[:port] (port defaults to 4730)
			'servers' => '127.0.0.1:4730', // Eg.: '10.0.1.10,10.0.1.11,10.0.1.11:4731'
			'functions' => array(
//				'Task_Reverse' => array(
//					'callback' => array('Task_Reverse', 'work'),
//					'timeout' => 3600,
//				),
			),
		),
	),
	'client' => array(
		'default' => array(
			'driver' => 'PECL',
			// Comma-separated list, format host[:port] (port defaults to 4730)
			'servers' => '127.0.0.1:4730', // Eg.: '10.0.1.10,10.0.1.11,10.0.1.11:4731'
		),
	),
);
