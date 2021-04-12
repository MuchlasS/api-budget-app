<?php
    class Balance {
        private $table = 'balances';

        public $id;
        public $income_amount;
        public $expense_amount;
        public $income_date;
        public $expense_date;
        public $category_id;
        public $category_name;
        public $created_at;

        public function read(PDO $db_connection){
            $query = '
            SELECT
                categories.name AS category_name,
                balances.id,
                balances.income_amount,
                balances.expense_amount,
                balances.income_date,
                balances.expense_date,
                balances.category_id,
                balances.created_at
            FROM
                '.$this->table.'
            LEFT JOIN
                categories ON balances.category_id = categories.id
            ORDER BY
                balances.created_at DESC
            ';

            $statement = $db_connection->prepare($query);
            $statement->execute();
            return $statement;
        }
    }
?>