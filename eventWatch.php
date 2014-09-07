<?php

require 'vendor/autoload.php';

$server = React\EventLoop\Factory::create();
$context = new React\ZMQ\Context($server);

$listen = $context->getSocket(ZMQ::SOCKET_PULL);
$listen->bind('tcp://127.0.0.1:5555');

$listen->on('message', function ($msg) {
	echo "Rec: " . print_r($msg,1);
});

$listen->on('error', function ($e) {
	echo "ERR: " . $e->getMessage();
});

$server->run();
