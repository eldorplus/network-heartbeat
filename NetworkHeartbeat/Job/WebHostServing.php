<?php 

namespace NetworkHeartbeat\Job;

class HostAvailable extends \NetworkHeartbeat\Job\Base 
{
	public function execute()
	{
		try {
			if(sizeof($this->getConfig()->hosts) > 0){
				foreach ($this->getConfig()->hosts as $host => $url) {	
					$http = \curl_init($url);
					$result = \curl_exec($http);
					$http_status = \curl_getinfo($http, CURLINFO_HTTP_CODE);
					\curl_close($http);
					echo $host ' registering ' . $http_status;
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
