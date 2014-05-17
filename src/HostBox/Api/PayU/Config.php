<?php

namespace HostBox\Api\PayU;


class Config {

    const
        ENCODING_ISO_8859_2 = 'ISO',
        ENCODING_UTF_8 = 'UTF',
        ENCODING_WINDOWS_1250 = 'WIN';

    const
        FORMAT_XML = 'xml',
        FORMAT_TXT = 'txt';

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
    public function __construct($posId, $posAuthKey, $key1, $key2, $encoding = self::ENCODING_UTF_8, $format = self::FORMAT_XML) {
        $this->posId = $posId;
        $this->posAuthKey = $posAuthKey;
        $this->key1 = $key1;
        $this->key2 = $key2;
        $this->encoding = $encoding;
        $this->format = $format;
    }

    /** @return int */
    public function getPosId() {
        return $this->posId;
    }

    /** @return string */
    public function getPosAuthKey() {
        return $this->posAuthKey;
    }

    /** @return string */
    public function getKey1() {
        return $this->key1;
    }

    /** @return string */
    public function getKey2() {
        return $this->key2;
    }

    /** @return string */
    public function getEncoding() {
        return $this->encoding;
    }

    /** @return string */
    public function getFormat() {
        return $this->format;
    }

}
