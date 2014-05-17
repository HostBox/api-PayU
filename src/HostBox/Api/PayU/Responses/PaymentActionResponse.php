<?php

namespace HostBox\Api\PayU\Responses;


class PaymentActionResponse extends Response {

    /** @var int */
    protected $id;

    /** @var string */
    protected $posId;

    /** @var string */
    protected $sessionId;

    /** @var string */
    protected $ts;

    /** @var string */
    protected $sig;


    /** @return int */
    public function getId() {
        return $this->id;
    }

    /** @return string */
    public function getPosId() {
        return $this->posId;
    }

    /** @return string */
    public function getSessionId() {
        return $this->sessionId;
    }

    /** @return string */
    public function getTs() {
        return $this->ts;
    }

    /** @return string */
    public function getSig() {
        return $this->sig;
    }

}
