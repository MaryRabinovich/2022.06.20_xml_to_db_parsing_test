<?php declare(strict_types=1);

namespace Parsers;

use SimpleXMLElement;

final class GenerationsParser
{
    public static function getGenerationsWithIdsAndModels(SimpleXMLElement $xml): array
    {
        $generations = [];

        foreach ($xml->children() as $offer) {
            $generations[(int) $offer->generation_id] = [
                'generation' => (string) $offer->generation,
                'model' => (string) $offer->model
            ];
        }

        return $generations;
    }
}
