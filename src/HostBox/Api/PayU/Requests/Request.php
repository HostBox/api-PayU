<?php

namespace HostBox\Api\PayU\Requests;

use HostBox\Api\PayU\Exceptions\LogicException;
use HostBox\Api\PayU\Strings;
use Nette\Reflection\ClassType;
use Nette\Utils\ArrayHash;


/**
 * @method int getPosId
 * @method void setPosId($posId)
 *
 * @method string getSessionId
 * @method void setSessionId($sessionId)
 *
 * @method string getTs
 * @method void setTs($ts)
 */
abstract class Request implements IRequest {

    /** @var int @required */
    protected $posId;

    /** @var string @required @range(1,1024) */
    protected $sessionId;

    /** @var string @required */
    protected $ts;


    /**
     * @param $name
     * @param $arguments
     * @return mixed|void
     */
    public function __call($name, $arguments) {
        $prefix = substr($name, 0, 3);
        if ($prefix === 'get') {
            return $this->{lcfirst(substr($name, 3))};
        } elseif ($prefix === 'set') {
            $reflection = new ClassType($this);
            $propertyName = lcfirst(substr($name, 3));
            if ($reflection->hasProperty($propertyName) && ($range = $reflection->getProperty($propertyName)->getAnnotation('range')) !== NULL) {
                $dataLength = strlen($arguments[0]);
                if ($range instanceof ArrayHash && count($range) == 2 && ($range[0] > $dataLength || $dataLength > $range[1])) {
                    throw new LogicException(sprintf('%s bad range <%d,%d> ... value %d', $propertyName, $range[0], $range[1], $dataLength));
                } else if (is_integer($range) && $dataLength != $range) {
                    throw new LogicException('bad length ' . $propertyName . ' ' . strlen($name) . ' - ' . $range);
                }
            }
            $this->$propertyName = reset($arguments);
        }
    }

    /** @inheritdoc */
    public function getParameters($postId, $key) {
        $this->setPosId($postId);

        $reflection = new ClassType($this);
        $parameters = array();
        $errors = array();
        foreach ($reflection->getProperties() as $property) {
            if ($property->hasAnnotation('var') && $property->getAnnotation('var') == 'bool') {
                $getterPrefix = 'is';
            } else {
                $getterPrefix = 'get';
            }
            $propertyGetter = $getterPrefix . ucfirst($property->getName());
            $value = $this->$propertyGetter();
            if ($value !== NULL) {
                $parameters[] = Strings::camelToUnderdash($property->getName()) . '=' . $value;
            }

            if ($property->hasAnnotation('required') && $value === NULL) {
                $errors[] = $property->getName();
            }
        }

        if (count($errors) > 0) {
            throw new LogicException('empty properties with required: ' . implode(', ', $errors));
        }
        $parameters[] = 'sig=' . $this->getSig($key);

        return implode('&', $parameters);
    }

}
