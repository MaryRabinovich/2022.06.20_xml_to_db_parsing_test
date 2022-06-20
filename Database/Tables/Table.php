<?php declare(strict_types=1);

namespace Database\Tables;

use Database\DbConnection;

abstract class Table
{
    protected $dbConnection;

    protected $tableName;

    public function __construct()
    {
        $this->dbConnection = DbConnection::getConnection();
    }

    public function dropTable(): void
    {
        $query = "DROP TABLE IF EXISTS $this->tableName";

        $this->dbConnection->query($query);
    }

    abstract public function createTable(): void;

    
    public function getNamedIds(): array
    {
        $query = "SELECT id, name FROM $this->tableName";

        $rawResult = $this->dbConnection
                            ->query($query)
                            ->fetch_all(MYSQLI_ASSOC);

        $result = [];
        foreach ($rawResult as $row) {
            $result[$row['name']] = $row['id'];
        }

        return $result;
    }
}
