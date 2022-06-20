<?php declare(strict_types=1);

namespace Tests\Parser;

use Locator\Locator;
use Parser\ModelsParser;
use PHPUnit\Framework\TestCase;

final class ModelsParserTest extends TestCase
{
    /** @test */
    public function can_get_assoc_array_models_to_marks()
    {
        $xml = Locator::getXml([]);
        $offers = $xml->children()[0];
        $models = ModelsParser::getModelsWithMarks($offers);
        $this->assertIsArray($models);
        $this->assertSame($models[5285], 'Волжанин');
    }
}
