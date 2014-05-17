<?php

namespace HostBox\Api\PayU\Requests;

use HostBox\Api\PayU\Connection;


class PaymentCancelRequest extends PaymentInfoRequest {

    /** @inheritdoc */
    public function getType() {
        return Connection::REQUEST_CANCEL_PAYMENT;
    }

}
