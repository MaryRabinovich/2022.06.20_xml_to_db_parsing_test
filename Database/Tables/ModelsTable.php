<?php declare(strict_types=1);

namespace Database\Tables;

final class ModelsTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'models';
    }

    public function createTable(): void
    {
        $query = "CREATE TABLE IF NOT EXISTS models (
            id INT PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(50) UNIQUE,
            mark_id INT,
            CONSTRAINT fk_mark_model FOREIGN KEY (mark_id) REFERENCES marks(id)
        )";
        $this->dbConnection->query($query);
    }

    public function insert(string $modelName, int $markId): void
    {
        $query = "
            INSERT INTO $this->tableName (name, mark_id) 
            VALUES (?, ?)
        ";
        $stmt = $this->dbConnection->prepare($query);

        $stmt->bind_param('sd', $modelName, $markId);

        $stmt->execute();
    }
}
