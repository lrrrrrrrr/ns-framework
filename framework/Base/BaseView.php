<?php

namespace framework\Base;


class BaseView extends Component
{
    public function render($file, $params)
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        //TODO: I KNOW THAT IT's not good, had no time
        include __DIR__ . '/../../' .
            DIRECTORY_SEPARATOR .
            'app' .
            DIRECTORY_SEPARATOR .
            'View' .
            DIRECTORY_SEPARATOR .
            $file . '.php';
        return ob_get_clean();
    }
}