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
}
?>