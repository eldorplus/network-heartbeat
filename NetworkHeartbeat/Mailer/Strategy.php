<?php
/**
 * NetworkHeartbeat\Mailer\Strategy
 * @author Dustin Moorman <dustin.moorman@gmail.com>
 * 
 * Manages how the mail will be sent. Default implementation
 * is with Mandrill, additional methods of sending will be 
 * integrated here.
 * 
 * Note: Specific IMPLEMENTATIONS are not managed here, 
 * for Mandrill implementations, see 
 * NetworkHeartbeat\Mailer\Vendors\Mandrill\Implementations,
 * and make sure the Implementation follows the 
 * NetworkHeartbeat\Mailer\AdapterInterface.
 */

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
