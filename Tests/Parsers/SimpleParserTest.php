<?php declare(strict_types=1);

namespace Tests\Parsers;

use Locator\Locator;
use Parsers\SimpleParser;
use PHPUnit\Framework\TestCase;

final class SimpleParserTest extends TestCase
{
    /** @test */
    public function can_get_array_of_names_for_given_tag()
    {
        $xml = Locator::getXml([]);
        $offers = $xml->children()[0];
        $marks = SimpleParser::getNames($offers, 'mark');
        $this->assertIsArray($marks);
        $this->assertSame($marks[0], 'ГАЗ');
    }
}
