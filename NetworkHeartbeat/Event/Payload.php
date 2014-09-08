<?php

namespace NetworkHeartbeat\Event;

class Payload
{
	protected $_jobConfig;

	public function __construct(stdClass $jobConfig)
	{
		$this->_jobConfig = $jobConfig;
		$this->hydrateWithJobConfig();
	}

	
	
}
