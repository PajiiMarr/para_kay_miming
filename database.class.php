<?php
    class Database {
        protected $connection;

        function connect(){
            try {
                $this->connection = new PDO("mysql:host=localhost;dbname=assignment;", "root", "");
            } catch (PDOException $e) {
                echo "Error message:" . $e->getMessage();
            }
            return $this->connection;
        }
    }
?>