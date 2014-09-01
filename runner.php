<?php

define('APPLICATION_PATH', dirname(__FILE__));
define('JOB_DIRECTORY', APPLICATION_PATH . '/NetworkHeartbeat/Job/');

spl_autoload_register(function($class){
    require_once(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

$Job = factory($argv[1]);

if(!$Job instanceof \NetworkHeartbeat\Job\Base){
    echo $Job;
    exit;
}

$config_data = include 'config.php';
$Config = new stdClass();

recursivelyHydrate($Config, $config_data);

if(isset($Config->job->$argv[1])){
    $Job->setConfig($Config->job->$argv[1]);
}

if($Config->mailer->on){
    $Mailer = \NetworkHeartbeat\Mailer\Strategy::getMailer($Config);

}

//$Job->execute();

$Mailer->setBody('<h1>Network Heartbeat Test Victory!!!!</h1>');
$Mailer->addRecipient($Config->administrator->email, $Config->administrator->name);
$result = $Mailer->send();

print_r($result);

exit;
// runner should supply communication to mailer of errors

function factory($job_name){
    try {
        if(file_exists(JOB_DIRECTORY . $job_name . '.php')){
            $job = 'NetworkHeartbeat\Job\\' . $job_name;
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