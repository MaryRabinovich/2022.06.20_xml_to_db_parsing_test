<?php declare(strict_types=1);

namespace Tests\Database\Tables;

use Database\Migration;
use Database\Tables\CarsTable;
use Database\Tables\GenerationsTable;
use Database\Tables\ModelsTable;
use Database\Tables\SimpleTable;
use PHPUnit\Framework\TestCase;

final class CarsTableTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        Migration::down();
        Migration::up();
    }

    /** @test */
    public function can_insert_car_into_db()
    {
        $simpleTables = [
            'colors',
            'transmissions',
            'body_types',
            'engine_types',
            'gear_types',
            'marks'
        ];

        foreach ($simpleTables as $tableName) {
            $table = new SimpleTable($tableName);
            $table->insertNames(['a', 'b', 'c']);
        }

        $table = new ModelsTable();
        $table->insert('model', 1);

        $table = new GenerationsTable();
        $table->insert(1, 'generation', 1);

        $table = new CarsTable();
        $table->insert([
            'id' => 1,
            'year' => 1,
            'run' => 1,
            'color_id' => 1,
            'transmission_id' => 1,
            'body_type_id' => 1,
            'ingine_type_id' => 1,
            'gear_type_id' => 1,
            'generation_id' => 1
        ]);
        $ids = $table->getIds();

        $this->assertTrue(count($ids) > 0);
    }
}
