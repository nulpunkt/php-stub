<?php

namespace Nulpunkt\PhpStub;

class Stub
{
    private $methods = [];
    private $config = [
        'chainable' => true,
        'throw' => false,
        'exceptionclass' => 'RuntimeException',
        'exceptionmessage' => 'Undefined method'
    ];

    public function __construct($methods = [], $config = [])
    {
        $this->methods = $methods;
        $this->config = array_merge($this->config, $config);
    }

    public function __call($name, $arguments)
    {
        if (array_key_exists($name, $this->methods)) {
            if (is_callable($this->methods[$name])) {
                return call_user_func_array($this->methods[$name], $arguments);
            } else {
                return $this->methods[$name];
            }
        } elseif ($this->config['throw']) {
            throw new $this->config['exceptionclass']($this->config['exceptionmessage']);
        }

        if ($this->config['chainable'] === true) {
            return $this;
        } else {
            return null;
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->methods)) {
            return $this->methods[$name];
        }
        return null;
    }
    
    public function __set($name, $value)
    {
        $this->methods[$name] = $value;
    }

    public function __isset($property)
    {
        return isset($this->methods[$property]);
    }

    public function __unset($property)
    {
        unset($this->methods[$property]);
    }

    public function __toString()
    {
        return "";
    }
}
