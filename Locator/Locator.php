<?php declare(strict_types=1);

namespace Locator;

use Exception;
use Helpers\Config;

class Locator
{
    private static $filePath, $pathType;

    public static function getXml(array $arr): object
    {
        self::validateParam($arr);

        $path = self::buildPath();
        
        self::checkFileExistance($path);
        
        return simplexml_load_file($path);
    }

    public static function validateParam(array $arr): void
    {
        if (count($arr) === 0) {
            self::$pathType = Config::get('locator', 'default_path_type');
            self::$filePath = Config::get('locator', 'default_file_path');
            return;
        }

        if ($arr[0] !== 'abs' && $arr[0] !== 'rel') {
            throw new Exception('Первый параметр команды должен быть abs|rel');
        }

        if (count($arr) === 1) {
            throw new Exception(
                "Параметров либо не должно быть 
                (тогда берётся файл по умолчанию), 
                либо должно быть два параметра: 
                тип пути и путь"
            );
        }

        self::$pathType = $arr[0];
        self::$filePath = $arr[1];
    }

    public static function buildPath(): string
    {
        if (self::$pathType === 'abs') return self::$filePath;

        $base = Config::get('locator', 'base');
        $pathToRoot = __DIR__.'/..';
        return $pathToRoot . $base . self::$filePath;
    }

    public static function checkFileExistance(string $path): void
    {
        if (!file_exists($path)) {
            throw new Exception(
                "Такого файла нет.

                Если при вызове команды параметры отсутствуют, 
                берётся файл по умолчанию 
                (задаётся в настройках).

                Если при вызове команды параметры есть,
                их должно быть минимум два,
                причём первый - тип пути (abs|rel,
                relative берётся внутри папки, 
                заданной в настройках),
                а второй - собственно путь к файлу."
            );
        }
    }
}
