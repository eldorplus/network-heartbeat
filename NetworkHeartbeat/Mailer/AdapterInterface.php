<?php 

namespace NetworkHeartbeat\Mailer;

interface AdapterInterface
{
    public function send();
    public function addRecipient($email, $name = null);
    public function setBody();
}