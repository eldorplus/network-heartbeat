<?php

require 'vendor/autoload.php';

echo ":: EventWatch - Network Heartbeat";

$server = React\EventLoop\Factory::create();
$context = new React\ZMQ\Context($server);

echo "\r\nServer created...";

$listen = $context->getSocket(ZMQ::SOCKET_PULL);
$listen->bind('tcp://127.0.0.1:5555');

echo "Bound to socket, port 5555.";

$listen->on('message', function ($msg) {
	echo "Rec: " . print_r($msg,1);
});

$listen->on('error', function ($e) {
	echo "ERR: " . $e->getMessage();
});

echo "\r\nWatching for events.\r\n";
$server->run();
