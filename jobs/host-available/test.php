<?php 

namespace Network_Heartbeat\Jobs\Host_Available;

class Test 
{

	public function execute()
	{
		$s = 'time=';
		exec("ping  -c 3 $ip", $o, $status);

		$ms = array();
		foreach ($o as $l){
			 if(strpos($l,$s) !== FALSE)
             $ms[] = (int) substr($l,strrpos($l, $s)+strlen($s)) . "\r\n";
		}

	}
}
