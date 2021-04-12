<?php
    class Database {
        private $host = 'localhost';
        private $db_name = 'db_budget';
        private $db_username = 'root';
        private $db_password = '';
        private $db_connection;

        public function connect(){
            $this->db_connection = null;

            try {
                $this->db_connection = new PDO(
                    'mysql:host='.$this->host.
                    ';dbname='.$this->db_name,
                    $this->db_username,
                    $this->db_password
                );
                $this->db_connection->setAttribute(
                    PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION
                );
                $this->db_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                echo 'Connection Error: '.$exception->getMessage();
            }

            return $this->db_connection;
        }
    }
?>