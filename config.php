<?php

$mandrill_api_key = include 'mandrill.key.php';

return array (
	'administrator_email' => 'dustin.moorman@gmail.com',
	'hosts' => array(),
	'mailer' => array(
		'on' => true,
		'vendor' => array(
			'name' => 'Mandrill',
			'implementation' => 'Dustinmoorman',
			'from' => array(
				'name' => 'Network Heartbeat',
				'address' => 'neth@dustinmoorman.com',
				'reply' => 'dustin.moorman@gmail.com' 
			),
			'apiKey' => $mandrill_api_key
		)
	),
	'jobs' => array(
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
