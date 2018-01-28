<?php

namespace framework\Base;

use framework\Exception\RouteException;
use framework\Framework;

abstract class BaseApplication
{
    protected $defaultController = 'front';
    protected $defaultAction = 'index';
    /** @var array $config */
    protected $config;

    /**
     * BaseApplication constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $this->setConfig($config);
        // FIXME: Just a fast way, not OOP
        Framework::$application = $this;
        Framework::$config = $config;
    }

    /**
     * @param array $config
     * @return BaseApplication
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function runAction($route)
    {
        if (ltrim($route, '/') === '') {
            $route =  '/' . $this->defaultController . '/' . $this->defaultAction;
        }

        $data = explode('/', $route);
        $result = null;
        try {
            $result = $this->createController(isset($data[1]) ? $data[1] : $this->defaultController,
                isset($data[2]) ? $data[2] : 'index');
        } catch (RouteException $exception) {
            echo $exception->getMessage();
            Framework::log($exception->getMessage());
        }

        return $result;
    }

    public function createController($controllerName, $actionName)
    {
        $controllerName = 'app\Controller\\' . ucfirst($controllerName) . 'Controller';
        $actionName .= 'Action';
        if (!class_exists($controllerName)) {
            throw new RouteException('Invalid route: ' . $controllerName);
        }
        /** @var BaseController $controller */
        $controller = new $controllerName;
        if (!$controller->hasMethod($actionName)) {
            throw new RouteException('Action: ' . $actionName . ' not exists');
        }

        return $controller->{$actionName}();
    }


}