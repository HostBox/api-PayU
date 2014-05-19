<?php

namespace HostBoxTests\Api\PayU;

use HostBox\Api\PayU\Config;
use HostBox\Api\PayU\IConfig;
use HostBox\Api\PayU\Requests\NewPaymentRequest;
use HostBox\Api\PayU\Requests\PaymentCancelRequest;
use HostBox\Api\PayU\Requests\PaymentConfirmRequest;
use HostBox\Api\PayU\Requests\PaymentInfoRequest;
use Tester;

require_once __DIR__ . '/../../bootstrap.php';


class RequestTest extends Tester\TestCase {

    /** @var NewPaymentRequest */
    private $newPaymentRequest;

    /** @var IConfig */
    private $config;


    protected function setUp() {
        $this->config = new Config('1234', 'abcdefg', 'key1', 'key2');

        $this->newPaymentRequest = new NewPaymentRequest();
        $this->newPaymentRequest->setPosAuthKey('abcdefg');
        $this->newPaymentRequest->setSessionId(123);
        $this->newPaymentRequest->setAmount(10000);
        $this->newPaymentRequest->setDesc('TEST');
        $this->newPaymentRequest->setClientIp('127.0.0.1');
        $this->newPaymentRequest->setFirstName('Name');
        $this->newPaymentRequest->setLastName('Surname');
        $this->newPaymentRequest->setEmail('test@test.test');
        $this->newPaymentRequest->setLanguage('cs');
        $this->newPaymentRequest->setTs(123456789);
    }

    public function testSetters() {
        Tester\Assert::exception(function () {
            $request = new NewPaymentRequest();
            $request->setPosAuthKey('123456789');
        }, '\HostBox\Api\PayU\Exceptions\LogicException');

        Tester\Assert::exception(function () {
            $request = new NewPaymentRequest();
            $request->setAmount(10000000000);
        }, '\HostBox\Api\PayU\Exceptions\LogicException');

    }

    public function testGetSig() {
        $request = new PaymentInfoRequest();
        $request->setPosId(123);
        $request->setSessionId(456);
        $request->setTs(123456789);
        Tester\Assert::same('ab15a0d44bf9daaa61870ed033b22d88', $request->getSig('key1Test'));

        $request = new PaymentCancelRequest();
        $request->setPosId(456);
        $request->setSessionId(123);
        $request->setTs(987654321);
        Tester\Assert::same('0ece2c7ddc02ccff2e094eb1e1ec34ed', $request->getSig('key1Test2'));

        $request = new PaymentConfirmRequest();
        $request->setPosId(159);
        $request->setSessionId(753);
        $request->setTs(589632147);
        Tester\Assert::same('4f194190efec696dbf8c98d2c845e5f3', $request->getSig('key1Test3'));

        Tester\Assert::same('2cb801f4a22fab4c7d68664eab2f20c7', $this->newPaymentRequest->getSig('key1Test4'));
    }

    public function testGetParameters() {
        Tester\Assert::same(
            'pos_auth_key=abcdefg&amount=10000&desc=TEST&first_name=Name&last_name=Surname&email=test@test.test&language=cs&client_ip=127.0.0.1&pos_id=1234&session_id=123&ts=123456789&sig=eabc4e2e2825c51743b3ed673db6fb99',
            $this->newPaymentRequest->getParameters($this->config)
        );

        $this->newPaymentRequest->setAmount(9999);
        $this->newPaymentRequest->setDesc2('lorem');
        Tester\Assert::same(
            'pos_auth_key=abcdefg&amount=9999&desc=TEST&desc2=lorem&first_name=Name&last_name=Surname&email=test@test.test&language=cs&client_ip=127.0.0.1&pos_id=1234&session_id=123&ts=123456789&sig=9d72e0f7010db0f911131d2a86eb48e0',
            $this->newPaymentRequest->getParameters($this->config)
        );

        $config = $this->config;
        Tester\Assert::exception(function () use ($config) {
            $request = new NewPaymentRequest();
            $request->getParameters($config);
        }, '\HostBox\Api\PayU\Exceptions\LogicException');
    }

}

\run(new RequestTest());
