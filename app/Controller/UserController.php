<?php

namespace app\Controller;


use framework\Base\BaseController;

class UserController extends BaseController
{
    public function loginAction()
    {
        return $this->getView()->render('user/login', []);
    }

    public function logoutAction() {
        return 'logout';
    }
}