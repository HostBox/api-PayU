<?php

namespace HostBox\Api\PayU\Responses;

use DateTime;
use HostBox\Api\PayU\Strings;
use Nette\Reflection\ClassType;


abstract class Response {

    public function __construct(array $data) {
        $this->assign($data);
    }

    private function assign(array $data) {
        $errors = array();
        foreach ($data as $propertyName => $value) {
            $pr = new ClassType($this);

            if (trim($value) == '')
                $value = NULL;

            $propertyName = Strings::underdashToCamel($propertyName);
            if ($pr->hasProperty($propertyName)) {
                $property = $pr->getProperty($propertyName);
                if ($property->getAnnotation('var') == 'DateTime' && $value !== NULL) {
                    $value = new DateTime($value);
                }
                $this->$propertyName = $value;
            } else {
                $errors[] = $propertyName;
            }
        }

    }

}
