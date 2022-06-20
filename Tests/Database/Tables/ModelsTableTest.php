<?php declare(strict_types=1);

namespace Tests\Database\Tables;

use Database\Migration;
use Database\Tables\ModelsTable;
use Database\Tables\SimpleTable;
use PHPUnit\Framework\TestCase;

final class ModelsTableTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        Migration::down();
        Migration::up();
    }

    /** @test */
    public function can_insert_model_and_its_mark_id_into_db_and_can_get_assoc_arr_of_named_ids_drom_db()
    {
        $table = new SimpleTable('marks');
        $table->insertNames(['mark']);

        $table = new ModelsTable();
        $table->insert('model_1', 1);
        $table->insert('model_2', 1);

        $namedIds = $table->getNamedIds();
        $this->assertTrue(
            $namedIds['model_1'] === '1' &&
            $namedIds['model_2'] === '2'
        );
    }
}
