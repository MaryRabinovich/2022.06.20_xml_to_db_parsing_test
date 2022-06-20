<?php declare(strict_types=1);

use Database\Migration;
use Helpers\Config;
use Locator\Locator;

require 'vendor/autoload.php';

// echo Config::get('locator','base');

// array_shift($argv);
// $xml = Locator::getXml($argv);
// echo $xml->getName();
// $xml = Locator::getXml(['rel', 'offers.xml']);
// echo $xml->getName();

Migration::down();
Migration::up();

