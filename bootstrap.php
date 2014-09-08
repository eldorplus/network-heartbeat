<?php

define('APPLICATION_PATH', dirname(__FILE__));
define('JOB_DIRECTORY', APPLICATION_PATH . '/NetworkHeartbeat/Job/');

require 'vendor/autoload.php';

$config_data = include 'config.php';
$Config = new stdClass();

recursivelyHydrate($Config, $config_data);

function factory($job_name){
    try {
        if(file_exists(JOB_DIRECTORY . $job_name . '.php')){
            $job = 'NetworkHeartbeat\Job\\'. $job_name;
            return new $job;
        }    
        throw new Exception('Job does not exist.');
    } catch (Exception $e){
        return $e->getMessage();
    }   
}

function recursivelyHydrate($object, $array){
    foreach($array as $k => $v){
        if(is_array($v)){
            $object->$k = new stdClass();
            recursivelyHydrate($object->$k, $v);
        } else {
            $object->$k = $v; 
        }   
    }   
} 
