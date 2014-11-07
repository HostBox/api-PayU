<?php

namespace HostBox\Api\PayU;

use HostBox\Api\PayU\Exceptions\LogicException;
use HostBox\Api\PayU\Exceptions\ResponseException;
use HostBox\Api\PayU\Exceptions\RuntimeException;
use HostBox\Api\PayU\Requests\IRequest;
use HostBox\Api\PayU\Requests\NewPaymentRequest;
use HostBox\Api\PayU\Requests\PaymentCancelRequest;
use HostBox\Api\PayU\Requests\PaymentConfirmRequest;
use HostBox\Api\PayU\Requests\PaymentInfoRequest;
use HostBox\Api\PayU\Responses\IResponse;
use HostBox\Api\PayU\Responses\PaymentActionResponse;
use HostBox\Api\PayU\Responses\PaymentInfoResponse;


class PayU {

    /** @var Connection */
    private $connection;


    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /** @return Config */
    public function getConfig() {
        return $this->connection->getConfig();
    }

    /**
     * @param IRequest $request
     * @return string
     */
    public function getRequestUrl(IRequest $request) {
        return $this->connection->getUrl($request);
    }

    /**
     * @param IRequest $request
     * @return string
     */
    public function rawRequest(IRequest $request) {
        return $this->connection->request($request);
    }

    /**
     * @param PaymentInfoRequest $request
     * @return PaymentInfoResponse
     */
    public function paymentInfo(PaymentInfoRequest $request) {
        return $this->createResponseEntity($request);
    }

    /**
     * @param PaymentCancelRequest $request
     * @return PaymentInfoResponse
     */
    public function cancelPayment(PaymentCancelRequest $request) {
        return $this->createResponseEntity($request);
    }

    /**
     * @param PaymentConfirmRequest $request
     * @return PaymentInfoResponse
     */
    public function confirmPayment(PaymentConfirmRequest $request) {
        return $this->createResponseEntity($request);
    }

    /**
     * @param IResponse $response
     * @return bool
     */
    public function isResponseValid(IResponse $response) {
        return $response->isSigValid($this->getConfig()->getKey2());
    }

    /**
     * @param IRequest $request
     * @return void
     */
    public function prepareEntityForRequest(IRequest &$request) {
        if ($request instanceof NewPaymentRequest && $request->getPosAuthKey() === NULL && $request->getPosId() === NULL) {
            $request->setPosAuthKey($this->getConfig()->getPosAuthKey());
            $request->setPosId($this->getConfig()->getPosId());
        }
    }

    public function getRequestSig(IRequest $request) {
        return $request->getSig($this->getConfig()->getKey1());
    }

    /**
     * @param IRequest $request
     * @throws RuntimeException
     * @throws LogicException
     * @throws ResponseException
     * @return mixed
     */
    private function createResponseEntity(IRequest $request) {
        $this->prepareEntityForRequest($request);
        $response = $this->connection->request($request);
        switch ($this->connection->getConfig()->getFormat()) {
            case Config::FORMAT_XML:
            {
                if (($xml = @simplexml_load_string($response)) === FALSE) {
                    throw new RuntimeException('Response is not valid XML');
                }

                $status = strtoupper((string) $xml->status);
                if ($status == 'ERROR') {
                    throw new ResponseException((string) $xml->error->message, (int) $xml->error->nr);
                } else if ($status == 'OK') {
                    switch ($request->getType()) {
                        case Connection::REQUEST_GET_PAYMENT:
                            return new PaymentInfoResponse((array) $xml->trans);
                        case Connection::REQUEST_CONFIRM_PAYMENT:
                        case Connection::REQUEST_CANCEL_PAYMENT:
                            return new PaymentActionResponse((array) $xml->trans);
                        case Connection::REQUEST_NEW_PAYMENT:
                        default:
                            throw new LogicException('Not supported request type for response');
                    }
                } else {
                    throw new ResponseException('Unknown response status');
                }
            }
            case Config::FORMAT_TXT:
            default:
                throw new LogicException('Not supported response format');
        }
    }

}
