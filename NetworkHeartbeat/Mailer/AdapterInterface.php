<?php 

namespace NetworkHeartbeat\Mailer;

interface AdapterInterface
{
    public function send();
    public function addRecipient();
    public function setBody();
}