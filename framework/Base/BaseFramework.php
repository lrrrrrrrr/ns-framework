<?php

namespace framework\Base;


abstract class BaseFramework
{
    const LOG_PATH = __DIR__ . '../../../log/log.txt';

    public static $config;
    /** @var BaseApplication*/
    public static $application;

    public static function log($message) {
        file_put_contents(self::LOG_PATH,  date('Y-m-d H:i:s') . ': ' . $message . "\n", FILE_APPEND);
    }
}