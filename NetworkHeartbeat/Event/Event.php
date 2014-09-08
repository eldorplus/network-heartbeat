<?php

namespace NetworkHeartbeat\Event;

class Event 
{
	protected $payload;

	public function __construct($eventType, $message = '')
	{
		$this->payload = new stdClass();
		
	}

	public function getPayload()
	{
		return $this->payload;
	}
}
