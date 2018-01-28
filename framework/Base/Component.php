<?php

namespace framework\Base;

use framework\Framework;

abstract class Component
{
    public function __construct()
    {
        $this->init();
    }

    public function getConfig()
    {
        $config = Framework::$config;
        if (array_key_exists( static::class, $config)) {
            return $config[static::class];
        }

        return [];
    }

    public function init()
    {
    }

    public function hasMethod($name) {
        return method_exists($this, $name);
    }
}