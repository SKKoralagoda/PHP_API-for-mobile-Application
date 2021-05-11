<?php
    class Report {
        //DB
        private $conn;
        private $table = 'report';

        //User Properties
        public $userid;
        public $risk;
        public $recommended;

        //DB symptoms Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create Report
        public function createTestReport(){
            $query = 'INSERT INTO ' . $this->table .'
                SET
                    userid = :userid';

            $stmt = $this->conn->prepare($query); //prepare statement

            $this->userid = htmlspecialchars(strip_tags($this->userid));

            //Bind Data
            $stmt->bindParam(':userid', $this->userid);

            //Execute
             if($stmt->execute()){
                return true;
            }

            //echo error 
            printf("ERROR: %s.\n", $stmt->error);
            return false;

        }

        //Update Report
        public function updateTestReport(){
            $query = 'UPDATE ' . $this->table .'
                SET
                    risk = :risk,
                    recommended = :recommended
                WHERE 
                    userid = :userid';

            $stmt = $this->conn->prepare($query); //prepare statement

            $this->userid = htmlspecialchars(strip_tags($this->userid));
            $this->risk = htmlspecialchars(strip_tags($this->risk));
            $this->recommended = htmlspecialchars(strip_tags($this->recommended));
  
            //Bind Data
            $stmt->bindParam(':userid', $this->userid);
            $stmt->bindParam(':risk', $this->risk);
            $stmt->bindParam(':recommended', $this->recommended);
         
            //Execute
            if($stmt->execute()){
                return true;
            }

            //echo error 
            printf("ERROR: %s.\n", $stmt->error);
            return false;
       
        }   

        //Get All report data according to userID
        public function getReportbyUserID(){
            //Query
            $query = 'SELECT * from ' . $this->table . ' WHERE userid = :userid';
    
            $stmt = $this->conn->prepare($query); //prepare statement
    
            $this->userid = htmlspecialchars(strip_tags($this->userid));
    
            //Bind Data
            $stmt->bindParam(':userid', $this->userid);
    
            //Execute
                if($stmt->execute()){
                return $stmt;
            }
    
            //echo error 
            printf("ERROR: %s.\n", $stmt->error);
            return false;
        }

    }