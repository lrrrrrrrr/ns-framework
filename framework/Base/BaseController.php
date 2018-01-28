<?php

namespace framework\Base;

use framework\Component\View;

abstract class BaseController extends Component
{
    public function getView()
    {
        return new View();
    }

    //TODO: Move to Response, make SEF support
    public function redirect($route)
    {
        header("Location: ?route=" . $route);
    }
}