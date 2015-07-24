<?php

namespace HostBox\Api\PayU\Requests;


/**
 * @method string getPayType
 * @method void setPayType($payType)
 *
 * @method string getPosAuthKey
 * @method void setPosAuthKey($posAuthKey)
 *
 * @method number getAmount
 * @method void setAmount($amount)
 *
 * @method string getDesc
 * @method void setDesc($desc)
 *
 * @method string getOrderId
 * @method void setOrderId($orderId)
 *
 * @method string getDesc2
 * @method void setDesc2($desc2)
 *
 * @method string getFirstName
 * @method void setFirstName($firstName)
 *
 * @method string getLastName
 * @method void setLastName($lastName)
 *
 * @method string getStreet
 * @method void setStreet($street)
 *
 * @method string getStreetHn
 * @method void setStreetHn($streetHn)
 *
 * @method string getStreetAn
 * @method void setStreetAn($streetAn)
 *
 * @method string getCity
 * @method void setCity($city)
 *
 * @method string getPostCode
 * @method void setPostCode($postCode)
 *
 * @method string getCountry
 * @method void setCountry($country)
 *
 * @method string getEmail
 * @method void setEmail($email)
 *
 * @method string getPhone
 * @method void setPhone($phone)
 *
 * @method string getLanguage
 * @method void setLanguage($language)
 *
 * @method string getClientIp
 * @method void setClientIp($clientIp)
 *
 * @method string getJs
 * @method void setJs($js)
 */
class NewPaymentRequest extends Request
{

	/** @var string */
	protected $payType;

	/** @var string @required @range(7) */
	protected $posAuthKey;

	/** @var number @required @range(1,10) */
	protected $amount;

	/** @var string @required @range(1,50) */
	protected $desc;

	/** @var string @range(1,2014) */
	protected $orderId;

	/** @var string @range(0,1024) */
	protected $desc2;

	/** @var string @required @range(0,100) */
	protected $firstName;

	/** @var string @required @range(0,100) */
	protected $lastName;

	/** @var string @range(0,100) */
	protected $street;

	/** @var string @range(0,10) */
	protected $streetHn;

	/** @var string @range(0,10) */
	protected $streetAn;

	/** @var string @range(0,100) */
	protected $city;

	/** @var string @range(0,20) */
	protected $postCode;

	/**
	 * Country code (2 letters) according to ISO-3166 http://www.chemie.fu-berlin.de/diverse/doc/ISO_3166.html
	 * @var string @range(0,100)
	 */
	protected $country;

	/** @var string @required */
	protected $email;

	/** @var string */
	protected $phone;

	/**
	 * Language code according to ISO-639 http://www.ics.uci.edu/pub/ietf/http/related/iso639.txt
	 * @var string @required @range(0,100)
	 */
	protected $language;

	/** @var string @required @range(7,15) */
	protected $clientIp;

	/** @var bool */
	protected $js;


	/** @inheritdoc */
	public function getType()
	{
		return Request::NEW_PAYMENT;
	}

	/** @inheritdoc */
	public function getSig($key)
	{
		return md5($this->posId . $this->payType . $this->sessionId . $this->posAuthKey . $this->amount . $this->desc .
			$this->desc2 . $this->orderId . $this->firstName . $this->lastName . $this->street . $this->streetHn .
			$this->streetAn . $this->city . $this->postCode . $this->country . $this->email . $this->phone .
			$this->language . $this->clientIp . $this->ts . $key
		);
	}

}
