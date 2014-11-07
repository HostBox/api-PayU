<?php

namespace HostBox\Api\PayU;


class Config implements IConfig {

    /** @var int */
    private $posId;

    /** @var string */
    private $posAuthKey;

    /** @var string */
    private $key1;

    /** @var string */
    private $key2;

    /** @var string */
    private $encoding;

    /** @var string */
    private $format;


    /**
     * @param int $posId
     * @param string $posAuthKey
     * @param string $key1
     * @param string $key2
     * @param string $encoding
     * @param string $format
     */
    public function __construct($posId, $posAuthKey, $key1, $key2, $encoding = IConfig::ENCODING_UTF_8, $format = IConfig::FORMAT_XML) {
        $this->posId = $posId;
        $this->posAuthKey = $posAuthKey;
        $this->key1 = $key1;
        $this->key2 = $key2;
        $this->encoding = $encoding;
        $this->format = $format;
    }

    /** @inheritdoc */
    public function getPosId() {
        return $this->posId;
    }

    /** @inheritdoc */
    public function getPosAuthKey() {
        return $this->posAuthKey;
    }

    /** @inheritdoc */
    public function getKey1() {
        return $this->key1;
    }

    /** @inheritdoc */
    public function getKey2() {
        return $this->key2;
    }

    /** @inheritdoc */
    public function getEncoding() {
        return $this->encoding;
    }

    /** @inheritdoc */
    public function getFormat() {
        return $this->format;
    }

}
