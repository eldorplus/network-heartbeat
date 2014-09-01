<?php

/**
* Create a new file in the application root, and have it 
* return your mandrill API key. It will be excluded from
* git.
*/
$mandrill_api_key = include 'mandrill.key.php';

return array (
	/**
	* Administrator details, your name and email.
	*/
	'administrator' => array(
		'email' => 'dustin.moorman@gmail.com',
		'name' => 'Dustin Moorman'
	),
	'hosts' => array(),
	'mailer' => array(
		'on' => true,
		'vendor' => array(
			'name' => 'Mandrill',
			'implementation' => 'Dustinmoorman',
			/**
			* The 'from' information is for the automated 
			* system that will be sending you notification 
			* emails.
			*/
			'from' => array(
				'name' => 'Network Heartbeat',
				'address' => 'neth@dustinmoorman.com',
				'reply' => 'dustin.moorman@gmail.com' 
			),
			'apiKey' => $mandrill_api_key
		)
	),
	/**
	* Job configuration. Each job has its own
	* distinct variable scope. Any keys and values
	* made here will be available in each job
	* respectively.
	*/
	'job' => array(
		'HostAvailable' => array(
			'ping_count' => 3,
			'high_ping_threshold_ms' => 300,
			'acceptable_packet_loss_percent' => 1,
			'hosts' => array(
				'test' => '192.168.1.1'
			),
		),
		'networkAvailable' => array(
			'wait_time_seconds' => 5,
		),
	),
);
