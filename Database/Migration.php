<?php declare(strict_types=1);

namespace Database;

use Database\Tables\CarsTable;
use Database\Tables\GenerationsTable;
use Database\Tables\ModelsTable;
use Database\Tables\SimpleTable;

final class Migration
{
    private static $simpleTables = [
        'colors',
        'transmissions',
        'body_types',
        'engine_types',
        'gear_types',
        'marks'
    ];

    public static function up()
    {
        foreach (self::$simpleTables as $tableName) {
            $table = new SimpleTable($tableName);
            $table->createTable();
        }

        $table = new ModelsTable();
        $table->createTable();

        $table = new GenerationsTable();
        $table->createTable();
        
        $table = new CarsTable();
        $table->createTable();
    }

    public static function down()
    {
        $table = new CarsTable();
        $table->dropTable();

        $table = new GenerationsTable();
        $table->dropTable();

        $table = new ModelsTable();
        $table->dropTable();

        foreach (self::$simpleTables as $tableName) {
            $table = new SimpleTable($tableName);
            $table->dropTable();
        }
    }
}
