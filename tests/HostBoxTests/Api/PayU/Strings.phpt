<?php

namespace HostBoxTests\Api\PayU;

use HostBox\Api\PayU\Strings;
use Tester;

require_once __DIR__ . '/../../bootstrap.php';


class StringsTest extends Tester\TestCase
{

	public function testCamelToUnderdash()
	{
		Tester\Assert::same('pos_auth_key', Strings::camelToUnderdash('posAuthKey'));
		Tester\Assert::same('first_name', Strings::camelToUnderdash('firstName'));
		Tester\Assert::same('something', Strings::camelToUnderdash('something'));
		Tester\Assert::same('upper_first', Strings::camelToUnderdash('UpperFirst'));
	}

	public function testUnderdashToCamel()
	{
		Tester\Assert::same('posAuthKey', Strings::underdashToCamel('pos_auth_key'));
		Tester\Assert::same('firstName', Strings::underdashToCamel('first_name'));
		Tester\Assert::same('something', Strings::underdashToCamel('something'));
	}

}

\run(new StringsTest());
