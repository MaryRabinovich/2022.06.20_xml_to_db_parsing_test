<?php declare(strict_types=1);

$start = strtotime('now');

use Locator\Locator;
use Database\Migration;
use Database\Tables\CarsTable;
use Database\Tables\GenerationsTable;
use Database\Tables\ModelsTable;
use Database\Tables\SimpleTable;
use Helpers\CarXmlToAssocConverter;
use Parser\GenerationsParser;
use Parser\ModelsParser;
use Parser\SimpleParser;

require 'vendor/autoload.php';

array_shift($argv);
$xml = Locator::getXml($argv);
$offers = $xml->children()[0];

Migration::down();
Migration::up();

$simpleTables = [
    'colors' => 'color',
    'transmissions' => 'transmission',
    'body_types' => 'body-type',
    'engine_types' => 'engine-type',
    'gear_types' => 'gear-type',
    'marks' => 'mark'
];

$namedIds = [];

foreach ($simpleTables as $tableName => $tag) {
    $names = SimpleParser::getNames($offers, $tag);
    $table = new SimpleTable($tableName);
    $table->insertNames($names);
    $namedIds[$tableName] = $table->getNamedIds();
}

$modelsRaw = ModelsParser::getModelsWithMarks($offers);
$generationsRaw = GenerationsParser::getGenerationsWithIdsAndModels($offers);

$modelsTable = new ModelsTable();
$generationsTable = new GenerationsTable();

foreach ($modelsRaw as $modelName => $markName) {
    $modelsTable->insert(
        (string) $modelName, 
        (int) $namedIds['marks'][$markName]
    );
}
$modelsNamedIds = $modelsTable->getNamedIds();
foreach ($generationsRaw as $generationId => $arr) {
    $generationsTable->insert(
        $generationId, 
        $arr['generation'], 
        (int) $modelsNamedIds[$arr['model']]
    );
}

$cars = new CarsTable();
foreach ($offers as $offer) {
    $converted = CarXmlToAssocConverter::convert($offer, $namedIds);
    $cars->insert($converted);
}

$end = strtotime('now');
$time = $end - $start;
echo PHP_EOL, "Done in $time sec.", PHP_EOL, PHP_EOL;
