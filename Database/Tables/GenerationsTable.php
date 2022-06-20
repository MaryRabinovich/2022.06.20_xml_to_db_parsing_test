<?php declare(strict_types=1);

namespace Database\Tables;

final class GenerationsTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'generations';
    }

    public function createTable(): void
    {
        $query = "CREATE TABLE IF NOT EXISTS generations (
            id INT PRIMARY KEY,
            name VARCHAR(50),
            model_id INT,
            CONSTRAINT fk_generation_model FOREIGN KEY (model_id) REFERENCES models(id)
        )";
        $this->dbConnection->query($query);
    }

    public function insert(int $generationId, string $generationName, int $modelId)
    {
        $query = "
            INSERT INTO generations (id, name, model_id) 
            VALUES (?,?,?)
        ";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bind_param('dsd', $generationId, $generationName, $modelId);
        $stmt->execute();
    }
}
