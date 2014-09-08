<?php

namespace NetworkHeartbeat\Event;

class Event 
{
	const JOB_EXCEPTION = 'A Job Exception Has Occured';
	const HOST_HIGH_PING = 'Host Registering High Ping';
	const HOST_UNAVAILABLE = 'Unable to Reach Host';
	const PACKET_LOSS_THRESHOLD = 'Host Registering High Packet Loss';

	protected $_payload;
	protected $_jobConfig;

	public function __construct($eventType, $meta)
	{
		$this->_payload = new stdClass();
		$this->_payload->event = $eventType;
		$message = strlen($meta) > 0 
			? $meta
			: $eventType;
		$this->_payload->message = $message; 
	}

	public function getPayload()
	{
		return $this->_payload;
	}
}
