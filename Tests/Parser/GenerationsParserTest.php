<?php declare(strict_types=1);

namespace Tests\Parser;

use Locator\Locator;
use Parser\GenerationsParser;
use PHPUnit\Framework\TestCase;

final class GenerationsParserTest extends TestCase
{
    /** @test */
    public function can_get_assoc_array_models_to_marks()
    {
        $xml = Locator::getXml([]);
        $offers = $xml->children()[0];
        $generations = GenerationsParser::getGenerationsWithIdsAndModels($offers);
        $this->assertIsArray($generations);
        $this->assertSame($generations[20351648]['generation'], '(1959-1981)');
        $this->assertSame($generations[20351648]['model'], '13 «Чайка»');
    }
}
