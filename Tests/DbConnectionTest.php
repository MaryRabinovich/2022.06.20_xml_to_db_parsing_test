<?php declare(strict_types=1);

namespace Tests;

use Database\DbConnection;
use PHPUnit\Framework\TestCase;

final class DbConnectionTest extends TestCase
{
    /** @test */
    public function returns_mysql_db_connection()
    {
        $connection = DbConnection::getConnection();

        $this->assertStringContainsString(
            'mysql',
            $connection->client_info
        );
    }
}
