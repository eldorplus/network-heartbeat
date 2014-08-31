<?php 

namespace NetworkHeartbeat\Jobs;

class HostAvailable extends \NetworkHeartBeat\Jobs\Base 
{

	protected $_ping_count;

	public function __construct()
	{
		$this->setWithConfig();
	}

	public function execute($host)
	{
		$token = 'time=';
		exec("ping  -c {$this->_ping_count} {$host}", $result);

		$ms = array();
		foreach ($result as $line){
			if(strpos($line,$token) !== FALSE){
				$ms[] = (int) substr($line,strrpos($line, $token)+strlen($token));
			}
		}

	}

	public function setWithConfig()
	{
		$this->_ping_count = $this->getConfig()->ping_count;
	}
}
