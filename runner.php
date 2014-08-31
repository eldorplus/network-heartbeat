<?php

define('APPLICATION_PATH', dirname(__FILE__));
define('JOB_DIRECTORY', APPLICATION_PATH . '/NetworkHeartbeat/Jobs/');

spl_autoload_register(function($class){
    require_once(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

// runner will take a job name from argv, (class name)

$Job = factory($argv[1]);

print_r($Job);

// runner should find job

// runner should instantiate job

// runner should set job configs

// runner should execute job

// runner should supply communication to mailer of errors

function factory($job_name){
    try {
        if(file_exists(JOB_DIRECTORY . $job_name . '.php')){
            $job = 'NetworkHeartbeat\Jobs\\' . $job_name;
            return new $job;
        }        
        throw new Exception('Job does not exist.');
    } catch (Exception $e){
        return $e->getMessage();
    }
}
