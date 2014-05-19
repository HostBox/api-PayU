<?php

namespace HostBox\Api\PayU;


interface IConfig {

    const
        ENCODING_ISO_8859_2 = 'ISO',
        ENCODING_UTF_8 = 'UTF',
        ENCODING_WINDOWS_1250 = 'WIN';

    const
        FORMAT_XML = 'xml',
        FORMAT_TXT = 'txt';


    /** @return int */
    public function getPosId();

    /** @return string */
    public function getPosAuthKey();

    /** @return string */
    public function getKey1();

    /** @return string */
    public function getKey2();

    /** @return string */
    public function getEncoding();

    /** @return string */
    public function getFormat();

}
