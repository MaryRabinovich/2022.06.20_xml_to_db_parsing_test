<?php declare(strict_types=1);

namespace Tests\Database\Tables;

use Database\Migration;
use Database\Tables\SimpleTable;
use PHPUnit\Framework\TestCase;

final class SimpleTableTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        Migration::down();
        Migration::up();
    }

    /** @test */
    public function can_insert_an_array_of_names_into_db_and_can_get_assoc_arr_of_named_ids_drom_db()
    {
        $table = new SimpleTable('colors');
        $table->insertNames(['a', 'b']);
        $namedIds = $table->getNamedIds();
        $this->assertTrue(
            $namedIds['a'] === '1' &&
            $namedIds['b'] === '2'
        );
    }
}
