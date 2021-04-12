<?php
class Income {
    public $id;
    public $amount;
    public $date;
    public $category_id;
    public $category_name;
    public $created_at;
        
    public function read(PDO $db_connection){
        $query = 'SELECT
            categories.name AS category_name,
            incomes.id,
            incomes.amount,
            incomes.date,
            incomes.category_id
            FROM incomes
            LEFT JOIN categories
            ON incomes.category_id = categories.id
            ORDER BY incomes.created_at DESC';
        
        $statement = $db_connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function read_single(PDO $db_connection){
        $query = 'SELECT
            categories.name AS category_name,
            incomes.id,
            incomes.amount,
            incomes.date,
            incomes.category_id
            FROM incomes
            LEFT JOIN categories
            ON incomes.category_id = categories.id
            WHERE incomes.id = ?
            LIMIT 0,1';

        $statement = $db_connection->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->amount = $row['amount'];
        $this->date = $row['date'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    public function create(PDO $db_connection){
        $query = 'INSERT INTO incomes
        SET
            amount = :amount,
            date = :date,
            category_id = :category_id';
        
        $statement = $db_connection->prepare($query);
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $statement->bindParam(':amount', $this->amount);
        $statement->bindParam(':date', $this->date);
        $statement->bindParam(':category_id', $this->category_id);

        if($statement->execute()) return true;

        printf("Error : %s.\n", $statement->error);
        return false;
    }
}
?>