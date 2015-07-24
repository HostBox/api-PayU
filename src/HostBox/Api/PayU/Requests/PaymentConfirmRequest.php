<?php

namespace HostBox\Api\PayU\Requests;


class PaymentConfirmRequest extends PaymentInfoRequest
{

	/** @inheritdoc */
	public function getType()
	{
		return Request::CONFIRM_PAYMENT;
	}

}
