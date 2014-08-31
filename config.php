<?php
return array (
	'administrator_email' => 'dustinmoorman@gmail.com',
	'hosts' => array(),
	'high_ping_threshold_ms' => '300',
 	'mandrill_creds' => array(),
	'jobs' => array(
		'hostAvailable' => array(
			'ping_count' = 3,
			'acceptable_packet_loss_percent' => 1,
		),
		'networkAvailable' => array(
			'wait_time_seconds' => 5,
		),
	),
);
