<?php

namespace NetworkHeartbeat\Mailer\Vendors\Mandrill;

class Adapter
{
    public function __construct(\stdClass $Config){
        switch($Config->mailer->vendor->implementation){
            default:
            case 'Dustinmoorman':
                $implementation = new Implementation\Dustinmoorman($Config);
                break;
        }

        return $implementation;
    }
}