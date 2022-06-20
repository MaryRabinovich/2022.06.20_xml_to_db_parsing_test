<?php declare(strict_types=1);

namespace Tests;

use Helpers\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    /** @test */
    public function returns_correct_data_in_test_environement()
    {
        $env = require __DIR__.'/../env.php';

        if ($env != 'prod' && $env != 'test') {
            die ('Задайте окружение в файле env.php');
        }

        $this->assertSame(
            Config::get('locator', 'base'),
            '/data_test/'
        );
    }
}
