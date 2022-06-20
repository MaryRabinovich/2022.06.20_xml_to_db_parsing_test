<?php declare(strict_types=1);

namespace Tests\Database\Tables;

use Database\Migration;
use Database\Tables\GenerationsTable;
use Database\Tables\ModelsTable;
use Database\Tables\SimpleTable;
use PHPUnit\Framework\TestCase;

final class GenerationsTableTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        Migration::down();
        Migration::up();
    }

    /** @test */
    public function can_insert_generation_and_its_model_id_into_db_and_can_get_assoc_arr_of_named_ids_drom_db()
    {
        $table = new SimpleTable('marks');
        $table->insertNames(['mark']);

        $table = new ModelsTable();
        $table->insert('model', 1);

        $table = new GenerationsTable();
        $table->insert(2, 'generation', 1);

        $namedIds = $table->getNamedIds();
        $this->assertTrue(
            $namedIds['generation'] === '2'
        );
    }
}
