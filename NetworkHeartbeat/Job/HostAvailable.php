<?php 

namespace NetworkHeartbeat\Job;

class HostAvailable extends \NetworkHeartBeat\Job\Base 
{
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
}
