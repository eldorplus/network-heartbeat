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
		$event = new \StdClass();

		if (array_key_exists($triggeredEvent, $this->_events)) {
			$event->event = $triggeredEvent;
			$event->message = $this->_config[$triggeredEvent] . $meta;
			$this->_Emitter->transmit($event);
		} else {
			$event->event = 'Unknown Event';
			$event->message = 'An unknown event has been triggered.';
			$this->_Emitter->transmit($event);
		}
	}
	
	protected function registerEvents()
	{
		$this->_events = $this->getConfig()->events;
	}
}
