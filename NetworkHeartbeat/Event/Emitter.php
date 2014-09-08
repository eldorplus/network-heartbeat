<?php

namespace NetworkHeartbeat\Event;

class Emitter 
{

	protected $loop;

	protected $context;

	public function __construct()
	{
		$this->loop = \React\EventLoop\Factory::create();
		$this->context = new \React\ZMQ\Context($this->loop);
	}

	public function transmit($payload)
	{
		$push = $this->context->getSocket(\ZMQ::SOCKET_PUSH);
		$push->connect('tcp://127.0.0.1:5555');
		$push->send(serialize($payload));
		$this->loop->run();
	}

}
