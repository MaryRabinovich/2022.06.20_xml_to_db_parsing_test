<?php declare(strict_types=1);

namespace Database;

use Helpers\Config;

final class DbConnection
{
    private static $connection;

    public static function getConnection()
    {
        if (self::$connection) {
            return self::$connection;
        }

        self::$connection = mysqli_connect(
            Config::get('database', 'host'),
            Config::get('database', 'user'),
            Config::get('database', 'password'),
            Config::get('database', 'db_name')
        );

        return self::$connection;
    }
}
