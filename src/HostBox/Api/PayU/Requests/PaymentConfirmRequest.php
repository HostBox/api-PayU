<?php

namespace HostBox\Api\PayU\Requests;

use HostBox\Api\PayU\Connection;


class PaymentConfirmRequest extends PaymentInfoRequest {

    /** @inheritdoc */
    public function getType() {
        return Connection::REQUEST_CONFIRM_PAYMENT;
    }

}
