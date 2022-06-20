<?php declare(strict_types=1);

namespace Parser;

use SimpleXMLElement;

final class SimpleParser
{
    public static function getNames(SimpleXmlElement $xml, string $tagName): array
    {
        $names = [];

        foreach ($xml->children() as $offer) {
            $names[] = (string) $offer->$tagName;
        }

        return array_unique($names);
    }
}
