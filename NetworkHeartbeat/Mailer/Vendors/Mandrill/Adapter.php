<?php

namespace NetworkHeartbeat\Mailer\Vendors\Mandrill;

class Adapter
{
    public static function factory(\NetworkHeartbeat\Config $Config){
        switch($Config->mailer->vendor->implementation){
            default:
            case 'Dustinmoorman':
                $implementation = new Implementation\Dustinmoorman($Config);
                break;
        }

        return $implementation;
    }
}
