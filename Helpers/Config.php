<?php declare(strict_types=1);

namespace Helpers;

final class Config
{
    public static function get(string $file, string $key)
    {
        $env = require __DIR__.'/../env.php';

        if ($env === 'test') {
            $dir = 'config_test/';
        } elseif ($env === 'prod') {
            $dir = 'config/';
        }

        $path = $dir . $file . '.php';

        if (!file_exists($path)) {
            die("Config file '$path' is absent");
        }

        $arr = require $path;

        if (!isset($arr[$key])) {
            die("There is no '$key' key in config file $path");
        }

        return $arr[$key];
    }
}
