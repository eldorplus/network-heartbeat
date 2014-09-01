<?php

namespace NetworkHeartbeat\Mailer;

class Strategy
{
    public static function getMailer(\stdClass $Config)
    {
        switch ($Config->mailer->vendor->name){
            case 'Mandrill':
            default:
                $mailer = self::Mandrill($Config);
                break;
        }

        return $mailer;
    }

    public static function Mandrill(\stdClass $Config)
    {
        return Vendors\Mandrill\Adapter::factory($Config);
    }
}