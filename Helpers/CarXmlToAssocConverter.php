<?php declare(strict_types=1);

namespace Helpers;

use SimpleXMLElement;

final class CarXmlToAssocConverter
{
    public static function convert(SimpleXMLElement $car, array $namedIds): array
    {
        $colorName       = (string) $car->color;
        $transmissonName = (string) $car->transmission;
        $bodyTypeName    = (string) $car->{'body-type'};
        $engineTypeName  = (string) $car->{'engine-type'};
        $gearTypeName    = (string) $car->{'gear-type'};
        
        return [
            'id'   => (int) $car->id,
            'year' => (int) $car->year,
            'run'  => (int) $car->run,
            'generation_id'   => (int) $car->generation_id,
            'color_id'        => (int) $namedIds['colors'][$colorName],
            'transmission_id' => (int) $namedIds['transmissions'][$transmissonName],
            'body_type_id'    => (int) $namedIds['body_types'][$bodyTypeName],
            'engine_type_id'  => (int) $namedIds['engine_types'][$engineTypeName],
            'gear_type_id'    => (int) $namedIds['gear_types'][$gearTypeName],
        ];
    }
}
