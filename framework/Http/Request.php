<?php

namespace framework\Http;

use framework\Framework;

class Request
{

    public function getPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getRoute()
    {
        $urlManager = Framework::$application->getUrlManager();
        return $urlManager->parseRoute($this);
    }

    public function getParsedPath()
    {
        $path = parse_url($this->getPath());
        return isset($path['path']) ? $path['path'] : null;
    }
}