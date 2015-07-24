<?php

namespace HostBox\Api\PayU\Requests;


class PaymentCancelRequest extends PaymentInfoRequest
{

	/** @inheritdoc */
	public function getType()
	{
		return Request::CANCEL_PAYMENT;
	}

}
