<?php declare(strict_types=1);

namespace Parser;

use SimpleXMLElement;

final class ModelsParser
{
    public static function getModelsWithMarks(SimpleXMLElement $xml): array
    {
        $models = [];

        foreach ($xml->children() as $offer) {
            $models[(string) $offer->model] = (string) $offer->mark;
        }

        return $models;
    }
}
