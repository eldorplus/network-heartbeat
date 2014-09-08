<?php

require_once 'bootstrap.php';

$Job = factory($argv[1]);

if(!$Job instanceof \NetworkHeartbeat\Job\Base){
    echo $Job;
    exit;
}

if(isset($Config->job->$argv[1])){
    $Job->setConfig($Config->job->$argv[1]);
}

if($Config->mailer->on){
    $Mailer = \NetworkHeartbeat\Mailer\Strategy::getMailer($Config);

}

$result = $Job->execute();

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
