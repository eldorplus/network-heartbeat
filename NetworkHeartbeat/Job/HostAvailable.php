<?php 

namespace NetworkHeartbeat\Job;

class HostAvailable extends \NetworkHeartbeat\Job\Base 
{
	public function execute()
	{
		try {
			if(sizeof($this->getConfig()->hosts) > 0){
				$token = 'time=';
				foreach($this->getConfig()->hosts as $host){

					exec("ping  -c {$this->getConfig()->ping_count} {$host}", $result);
					
					$ms = array();
					foreach ($result as $line){
						if(strpos($line,$token) !== false){
							$ms[] = (int) substr($line,strrpos($line, $token) + strlen($token));
						}

						if(strrpos($line, '%')){
							$loss = (int) substr($line, strrpos($line, ',')); 
						}
					}
					
					if($loss == 100) {
						$this->triggerEvent(\NetworkHeartbeat\Event\Event::HOST_UNAVAILABLE, $host);
					} else {

						if ($loss > $this->getConfig()->acceptable_packet_loss_percent) {
							$this->triggerEvent(\NetworkHeartbeat\Event\Event::PACKET_LOSS_THRESHOLD, $host);
						}
					
						foreach($ms as $msec){
							if($msec > $this->getConfig()->high_ping_threshold_ms){
								$this->triggerEvent(\NetworkHeartbeat\Event\Event::HOST_HIGH_PING, $host);
							}
						}
					}
				}	
			} else {
				throw new Exception('No hosts set to test in configuration.');
			}	
		} catch (Exception $e){
			$this->triggerEvent(\NetworkHeartbeat\Event::JOB_EXCEPTION, $e->getMessage());
			return false;
		}
		return true;
	}
}
