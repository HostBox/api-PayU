<?php

namespace HostBox\Api\PayU\Requests;

use HostBox\Api\PayU\Config;


interface IRequest
{

	/**
	 * @param Config $config
	 * @return string
	 */
	public function getConnectionParameters(Config $config);

	/** @return string */
	public function getType();

	/**
	 * @param string $key
	 * @return string
	 */
	public function getSig($key);

}
