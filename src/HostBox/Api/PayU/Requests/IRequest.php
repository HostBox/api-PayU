<?php

namespace HostBox\Api\PayU\Requests;


interface IRequest {

    /**
     * @param int $postId
     * @param string $key
     * @return string
     */
    public function getParameters($postId, $key);

    /** @return string */
    public function getType();

    /**
     * @param string $key
     * @return string
     */
    public function getSig($key);

}
