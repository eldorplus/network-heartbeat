<?php

namespace NetworkHeartbeat;

class Config 
{
	public function setWithArray($config_array)
	{
		foreach ($config_array as $property => $value) {
			if(is_array($value)) {
				$this->$property = new Config();
				$this->$property->setWithArray($value);
			} else {
				$this->$property = $value;
			}
		}
	}
}
