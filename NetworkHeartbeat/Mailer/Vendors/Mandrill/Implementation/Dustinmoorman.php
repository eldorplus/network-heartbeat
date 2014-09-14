<?php

namespace NetworkHeartbeat\Mailer\Vendors\Mandrill\Implementation;

class Dustinmoorman implements \NetworkHeartbeat\Mailer\AdapterInterface
{
    protected $_Mandrill;

    public function __construct(\NetworkHeartbeat\Config $Config)
    {
        $this->_Mandrill = new \Dustinmoorman\Mandrill\Mandrill(
            $Config->mailer->vendor->from->name,
            $Config->mailer->vendor->from->address,
            $Config->mailer->vendor->from->reply,
            $Config->mailer->vendor->apiKey
        );
    }

    public function send()
    {
        return $this->_Mandrill->send();
    }

    public function addRecipient($email, $name = '')
    {
        $this->_Mandrill->addRecipient($email, $name);
    }

    public function setBody($body)
    {
        $this->_Mandrill->setHTML($body);
    }

	public function setTitle($title)
	{
		$this->_Mandrill->setTitle($title);
	}
}
