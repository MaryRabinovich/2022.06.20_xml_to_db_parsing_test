<?php declare(strict_types=1);

namespace Database\Tables;

final class SimpleTable extends Table
{
    public function __construct(string $tableName)
    {
        parent::__construct();
        $this->tableName = $tableName;
    }

    public function createTable(): void
    {
        $query = "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) UNIQUE
        )";
        $this->dbConnection->query($query);
    }

    public function insertNames(array $names): void
    {
        $query = "INSERT INTO $this->tableName (name) VALUES (?)";

        $stmt = $this->dbConnection->prepare($query);
        
        foreach ($names as $name) {
            $stmt->bind_param('s', $name);
            $stmt->execute();
        }
    }
}
