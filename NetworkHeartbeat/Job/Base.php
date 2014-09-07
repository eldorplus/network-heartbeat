<?php

namespace NetworkHeartbeat\Job;

abstract class Base 
{
	private $_config;

	private $Emitter;

	public function __construct()
	{
		$this->Emitter = new \NetworkHeartbeat\Event\Emitter();
	}

	protected function getConfig()
	{
		return $this->_config;
	}

	public function setConfig(\stdClass $config){
		$this->_config = $config;
	}
}
