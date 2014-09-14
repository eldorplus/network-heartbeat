<?php

require_once 'vendor/autoload.php';
echo ":: EventWatch - Network Heartbeat";

$server = React\EventLoop\Factory::create();
$context = new React\ZMQ\Context($server);

echo "\r\nServer created...";

$listen = $context->getSocket(ZMQ::SOCKET_PULL);
$listen->bind('tcp://127.0.0.1:5555');

echo "Bound to socket, port 5555.";

$listen->on('message', function ($msg) {
	$event = unserialize($msg);

	require_once 'vendor/autoload.php';

	$config_data = include 'config.php';
	$Config = new \NetworkHeartbeat\Config();
	$Config->setWithArray($config_data);

	$mailer = NetworkHeartbeat\Mailer\Strategy::getMailer($Config);
	$mailer->setBody($event->message);
	$mailer->setTitle($event->event);
	$mailer->addRecipient($Config->administrator->email, $Config->administrator->name);

	echo "\r\nEvent Triggered " . $event->event . ' with message: ' . $event->message;
	print_r($mailer->send()); 
});

$listen->on('error', function ($e) {
	echo "\r\nERR: " . $e->getMessage();
});

echo "\r\nWatching for events.\r\n";
$server->run();
