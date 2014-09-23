<?php

namespace NetworkHeartbeat\Job;

abstract class Base 
{
	private $_config;
	private $_Emitter;
	private $_events;

	public function __construct()
	{
		$this->_Emitter = new \NetworkHeartbeat\Event\Emitter();
	}

	protected function getConfig()
	{
		return $this->_config;
	}

	public function setConfig(\NetworkHeartbeat\Config $Config){
		$this->_config = $Config;
	}

	public function triggerEvent($triggeredEvent, $meta = '')
	{
		$event = new \NetworkHeartbeat\Event\Event($triggeredEvent, $meta);
		$this->_Emitter->transmit($event->getPayload());
	}
	
	public function registerEvents()
	{
		$this->_events = $this->getConfig()->events;
	}
}
