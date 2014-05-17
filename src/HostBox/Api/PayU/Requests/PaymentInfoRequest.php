<?php

namespace HostBox\Api\PayU\Requests;

use HostBox\Api\PayU\Connection;


class PaymentInfoRequest extends Request {

    /** @inheritdoc */
    public function getType() {
        return Connection::REQUEST_GET_PAYMENT;
    }

    /** @inheritdoc */
    public function getSig($key) {
        return md5($this->posId . $this->sessionId . $this->ts . $key);
    }

}
