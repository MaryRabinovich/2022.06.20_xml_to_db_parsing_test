<?php declare(strict_types=1);

namespace Database\Tables;

final class CarsTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'cars';
    }

    public function createTable(): void
    {
        $query = "CREATE TABLE IF NOT EXISTS cars (
            id INT PRIMARY KEY,
            year INT,
            run INT,
            color_id INT,
            CONSTRAINT fk_car_color FOREIGN KEY (color_id) REFERENCES colors(id),
            transmission_id INT,
            CONSTRAINT fk_car_transmission FOREIGN KEY (transmission_id) REFERENCES transmissions(id),
            body_type_id INT,
            CONSTRAINT fk_car_body_type FOREIGN KEY (body_type_id) REFERENCES body_types(id),
            engine_type_id INT,
            CONSTRAINT fk_car_engine_type FOREIGN KEY (engine_type_id) REFERENCES engine_types(id),
            gear_type_id INT,
            CONSTRAINT fk_car_gear_type FOREIGN KEY (gear_type_id) REFERENCES gear_types(id),
            generation_id INT,
            CONSTRAINT fk_car_generation FOREIGN KEY (generation_id) REFERENCES generations(id)
        )";
        $this->dbConnection->query($query);
    }

    /**
     * Параметр - ассоциативный массив данных
     * по одному автомобилю,
     * с ключами = полями в таблице
     */
    public function insert(array $car): void
    {
        $query = "
            INSERT INTO cars (
                id, 
                year, 
                run, 
                color_id,
                transmission_id,
                body_type_id,
                engine_type_id,
                gear_type_id,
                generation_id
            ) VALUES (?,?,?,?,?,?,?,?,?)
        ";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bind_param(
            'ddddddddd', 
            $car['id'],
            $car['year'],
            $car['run'],
            $car['color_id'],
            $car['transmission_id'],
            $car['body_type_id'],
            $car['engine_type_id'],
            $car['gear_type_id'],
            $car['generation_id']
        );
        $stmt->execute();
    }

    public function getIds(): array
    {
        $query = "SELECT id FROM cars";

        return $this->dbConnection->query($query)->fetch_all();
    }
}
