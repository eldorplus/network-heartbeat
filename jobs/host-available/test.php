<?php 

namespace Network_Heartbeat\Jobs\Host_Available;

class Test extends \Network_HeartBeat\Jobs\Base 
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
             		$ms[] = (int) substr($l,strrpos($l, $s)+strlen($s));
		}

	}

	public function setWithConfig()
	{
		$this->_ping_count = $this->getConfig()->ping_count;
	}
}
