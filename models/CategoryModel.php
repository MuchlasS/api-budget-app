<?php
class Category {
    public $id;
    public $name;
    public $created_at;
        
    public function read(PDO $db_connection){
        $query = 'SELECT * FROM categories';
        
        $statement = $db_connection->prepare($query);
        $statement->execute();
        return $statement;
    }

    public function read_single(PDO $db_connection){
        $query = 'SELECT * FROM categories WHERE categories.id = ? LIMIT 0,1';

        $statement = $db_connection->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }

    public function create(PDO $db_connection){
        $query = 'INSERT INTO categories SET name = :name';
        
        $statement = $db_connection->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));

        $statement->bindParam(':name', $this->name);

        if($statement->execute()) return true;

        printf("Error : %s.\n", $statement->error);
        return false;
    }

    public function update(PDO $db_connection){
        $query = 'UPDATE categories SET name = :name WHERE id = :id';
        
        $statement = $db_connection->prepare($query);
        $this->name = htmlspecialchars(strip_tags($this->name));

        $statement->bindParam(':name', $this->name);
        $statement->bindParam(':id', $this->id);

        if($statement->execute()) return true;

        printf("Error : %s.\n", $statement->error);
        return false;
    }

    public function delete(PDO $db_connection){
        $query = 'DELETE FROM categories WHERE id = :id';

        $statement = $db_connection->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $statement->bindParam(':id', $this->id);

        if($statement->execute()) return true;

        printf("Error : %s.\n", $statement->error);
        return false;
    }
}
?>