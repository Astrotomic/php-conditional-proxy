<?php

namespace Astrotomic\ConditionalProxy;

class ConditionalProxy
{
    protected $object;
    protected $condition;

    /**
     * @param object $object
     * @param $condition
     */
    public function __construct($object, $condition)
    {
        $this->object = $object;
        $this->condition = $condition;
    }

    public function __call($name, $arguments)
    {
        if ($this->condition) {
            return call_user_func_array([$this->object, $name], $arguments);
        }

        return $this->object;
    }
}
