<?php

namespace HostBox\Api\PayU\Requests;

use HostBox\Api\PayU\IConfig;


interface IRequest {

    /**
     * @param IConfig $config
     * @return string
     */
    public function getParameters(IConfig $config);

    /** @return string */
    public function getType();

    /**
     * @param string $key
     * @return string
     */
    public function getSig($key);

}
