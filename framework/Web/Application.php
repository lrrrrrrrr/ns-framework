<?php

namespace framework\Web;

use framework\Base\BaseApplication;
use framework\Component\Imprint;
use framework\Component\MySqlConnection;
use framework\Component\UrlManager;
use framework\Framework;
use framework\Http\Request;
use framework\Http\Response;

class Application extends BaseApplication
{
    private $mysqlConnection;

    public function run()
    {
        $response = $this->handleRequest($this->getRequest());
        $response->send();

    }

    private function handleRequest(Request $request)
    {
        $route = $request->getRoute();
        if (!$route) {
            $route = $this->defaultController . '/' . $this->defaultAction;
        }

        $result = $this->runAction($route);

        if ($result instanceof Response) {
            return $result;
        }

        return new Response($result);
    }

    // TODO: BETTER TO ADD THIS TO ServiceLocator. No time for it now.

    /**
     * @return Request
     */
    public function getRequest()
    {
        return new Request();
    }

    public function getUrlManager()
    {
        return new UrlManager();
    }

    public function getImprint()
    {
        return new Imprint();
    }

    // MOVE TO SERVICE LOCATOR, should not be here
    public function getMysqlConnection()
    {
        if (!$this->mysqlConnection) {
            try {
                $this->mysqlConnection = new MySqlConnection();
                $this->mysqlConnection->open();
            } catch (\RuntimeException $exception) {
                Framework::log($exception->getMessage());
                echo $exception->getMessage();
            }
        }
        return $this->mysqlConnection;
    }

}