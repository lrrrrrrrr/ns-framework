<?php

namespace framework\Component;

use framework\Base\Component;
use framework\Exception\InvalidConfigurationException;
use framework\Http\Request;

class UrlManager extends Component
{

    public function init()
    {

    }

    /**
     * @param Request $request
     * @return null|string
     * @throws InvalidConfigurationException
     */
    public function parseRoute(Request $request)
    {
        $config = $this->getConfig();
        if (!isset($config['baseUrl'])) {
            throw new InvalidConfigurationException('No base url');
        }
        $currentRoute = $this->getRouteByParams();
        if (
            isset($config['rewrite'], $config['routes'])
            && $config['rewrite']
            && is_array($config['routes'])
        ) {
            $currentRoute = $request->getPath();
        }

        foreach ($config['routes'] as $routePattern => $route) {
            if (preg_match('#^' . $routePattern . '#', $currentRoute)) {
                return $route;
            }
        }

        return  '/' . ltrim($currentRoute,'/');
    }

    public function getRouteByParams()
    {
        if (isset($_GET['route'])) {
            return $_GET['route'];
        }

        return null;
    }

}