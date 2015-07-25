<?php

namespace HostBox\Api\PayU;

use HostBox\Api\PayU\Requests\IRequest;


interface IConnection
{

	const PAYU_URL = 'https://secure.payu.com/paygw';


	/** @return Config */
	public function getConfig();

	/**
	 * @param IRequest $request
	 * @return string
	 */
	public function request(IRequest $request);

	/**
	 * @param IRequest $request
	 * @return string
	 */
	public function getUrl(IRequest $request);

}
