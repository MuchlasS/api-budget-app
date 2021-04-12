<?php
class Expense {
    public $id;
    public $amount;
    public $date;
    public $category_id;
    public $category_name;
    public $created_at;
        
    public function read(PDO $db_connection){
        $query = 'SELECT
            categories.name AS category_name,
            expenses.id,
            expenses.amount,
            expenses.date,
            expenses.category_id
            FROM expenses
            LEFT JOIN categories
            ON expenses.category_id = categories.id
            ORDER BY expenses.created_at DESC';
        
        $statement = $db_connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function read_single(PDO $db_connection){
        $query = 'SELECT
            categories.name AS category_name,
            expenses.id,
            expenses.amount,
            expenses.date,
            expenses.category_id
            FROM expenses
            LEFT JOIN categories
            ON expenses.category_id = categories.id
            WHERE expenses.id = ?
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
        $query = 'INSERT INTO expenses
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

    public function update(PDO $db_connection){
        $query = 'UPDATE expenses
        SET
            amount = :amount,
            date = :date,
            category_id = :category_id
        WHERE
            id = :id';
        
        $statement = $db_connection->prepare($query);
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $statement->bindParam(':amount', $this->amount);
        $statement->bindParam(':date', $this->date);
        $statement->bindParam(':category_id', $this->category_id);
        $statement->bindParam(':id', $this->id);

        if($statement->execute()) return true;

        printf("Error : %s.\n", $statement->error);
        return false;
    }

    public function delete(PDO $db_connection){
        $query = 'DELETE FROM expenses WHERE id = :id';

        $statement = $db_connection->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $statement->bindParam(':id', $this->id);

        if($statement->execute()) return true;

        printf("Error : %s.\n", $statement->error);
        return false;
    }
}
?>