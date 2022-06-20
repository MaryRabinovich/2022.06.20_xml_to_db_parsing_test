<?php declare(strict_types=1);

namespace Tests;

use Exception;
use Locator\Locator;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

final class LocatorTest extends TestCase
{
    /** @test */
    public function when_array_of_parameters_is_empty_returns_default_xml()
    {
        $xml = Locator::getXml([]);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $this->assertSame($xml->getName(), 'auto-catalog');
    }

    /** @test */
    public function when_first_array_element_differs_from_abs_and_rel_throws_exception()
    {
        try {
            Locator::getXml(['different']);
        } catch (Exception $e) {
            $this->assertStringContainsString(
                'abs|rel',
                $e->getMessage()
            );
        }
    }

    /** @test */
    public function when_first_arr_el_is_correct_but_count_arr_is_1_throws_exception()
    {
        try {
            Locator::getXml(['abs']);
        } catch (Exception $e) {
            $this->assertStringContainsString(
                'либо',
                $e->getMessage()
            );
        }
    }

    /** @test */
    public function when_file_is_absent_throws_exception()
    {
        try {
            Locator::getXml(['rel', 'a']);
        } catch (Exception $e) {
            $this->assertStringContainsString(
                'Такого файла нет',
                $e->getMessage()
            );
        }
    }

    /** @test */
    public function returns_correct_xml_when_array_has_two_first_correct_elements_and_file_exists()
    {
        $xml = Locator::getXml(['rel', 'offers.xml']);

        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
        $this->assertSame($xml->getName(), 'auto-catalog');
    }

    /** @test */
    public function throws_exception_when_array_has_two_first_correct_elements_but_file_is_absent()
    {
        try {
            Locator::getXml(['rel', 'absent.xml']);
        } catch (Exception $e) {
            $this->assertStringContainsString(
                'Такого файла нет.',
                $e->getMessage()
            );
        }
    }
}
