<?php declare(strict_types=1);

use Helpers\Config;
use Locator\Locator;

require 'vendor/autoload.php';

// echo Config::get('locator','base');

array_shift($argv);
$path = Locator::getPath($argv);
