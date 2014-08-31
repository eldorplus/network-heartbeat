<?php
return array (
	'administrator_email' => 'dustinmoorman@gmail.com',
	'hosts' => array(),
 	'mandrill_creds' => array(
 		'apiKey' => 'b'
	),
	'jobs' => array(
		'hostAvailable' => array(
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
