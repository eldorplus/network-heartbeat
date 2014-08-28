<?php 

namespace Network_Heartbeat\Jobs\Host_Available;

class Test extends \Network_HeartBeat\Jobs\TestAbstract 
{

	protected $_ping_count;

	public function __construct()
	{
		$this->setWithConfig();
	}

	public function execute($host)
	{
		$s = 'time=';
		exec("ping  -c {$this->_ping_count} {$host}", $r, $status);

		$ms = array();
		foreach ($r as $l){
			 if(strpos($l,$s) !== FALSE)
             $ms[] = (int) substr($l,strrpos($l, $s)+strlen($s)) . "\r\n";
		}

	}

	public function setWithConfig()
	{
		
	}
}
