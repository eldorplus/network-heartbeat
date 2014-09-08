<?php

define('APPLICATION_PATH', dirname(__FILE__));
define('JOB_DIRECTORY', APPLICATION_PATH . '/NetworkHeartbeat/Job/');

require 'vendor/autoload.php';

$config_data = include 'config.php';
$Config = new stdClass();

recursivelyHydrate($Config, $config_data);

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
