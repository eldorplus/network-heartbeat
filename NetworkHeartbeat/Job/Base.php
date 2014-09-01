<?php

namespace NetworkHeartbeat\Job;

abstract class Base 
{
	private $_config;

	protected function getConfig()
	{
		return $this->_config;
	}

	public function setConfig(\stdClass $config){
		$this->_config = $config;
	}
}
