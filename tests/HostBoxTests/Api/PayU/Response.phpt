<?php

namespace HostBoxTests\Api\PayU;

use HostBox\Api\PayU\Responses\PaymentInfoResponse;
use Tester;

require_once __DIR__ . '/../../bootstrap.php';


class ResponseTest extends Tester\TestCase {

    public function testAssign() {
        $response = new PaymentInfoResponse(array(
            'id' => "123456789",
            'create' => "2014-05-15 17:36:53",
            'sent' => NULL,
            'cancel' => "",
            'ts' => "1400329307029",
            'sig' => "84e1a2ad46dadb0ec4af6de419484e74",
        ));

        Tester\Assert::same('123456789', $response->getId());
        Tester\Assert::equal(new \DateTime('2014-05-15 17:36:53'), $response->getCreate());
        Tester\Assert::same(NULL, $response->getSent());
        Tester\Assert::same(NULL, $response->getCancel());
        Tester\Assert::same('1400329307029', $response->getTs());
        Tester\Assert::same('84e1a2ad46dadb0ec4af6de419484e74', $response->getSig());
    }

}

\run(new ResponseTest());
