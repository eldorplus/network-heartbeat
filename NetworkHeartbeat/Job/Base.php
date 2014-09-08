<?php

namespace NetworkHeartbeat\Job;

abstract class Base 
{
	private $_config;
	private $_Emitter;

	public function __construct()
	{
		$this->_Emitter = new \NetworkHeartbeat\Event\Emitter();
	}

	protected function getConfig()
	{
		return $this->_config;
	}

	public function setConfig(\stdClass $config){
		$this->_config = $config;
	}

	public function triggerEvent($triggeredEvent, $meta = '')
	{
		$event = \NetworkHeartbeat\Event\Event($triggeredEvent, $meta);
		$this->_Emitter->transmit($event->getPayload());
	}

}
