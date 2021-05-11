
<?php

//ini_set("include_path", '/home4/chamathkaara/php:' . ini_get("include_path") );

    class Database{
        //params
        private $host = 'localhost';
        private $db_name = 'covid_app_db';
        private $username = 'root';
        private $password = '';
        private $conn;

        //Db connection
        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }

            return $this->conn;
        }


    }
