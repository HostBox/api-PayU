<?php

namespace HostBox\Api\PayU\Responses;


class NotificationResponse extends Response
{

	/** @inheritdoc */
	public function isSigValid($key2)
	{
		return ($this->getSig() == md5($this->getPosId() . $this->getSessionId() . $this->getTs() . $key2));
	}

}
