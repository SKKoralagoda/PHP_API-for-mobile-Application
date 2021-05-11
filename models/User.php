<?php

    class User {
        //DB
        private $conn;
        private $table = 'user';

        //User Properties
        public $firstname;
        public $lastname;
        public $houseno;
        public $lane;
        public $suburb;
        public $postcode;
        public $phone;
        public $email;
        public $age;
        public $gender;
        public $username;
        public $password;

        //DB User Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //User registration
        public function register(){
            $query = 'INSERT INTO ' . $this->table .'
                SET
                    firstname = :firstname,
                    lastname = :lastname,
                    houseno = :houseno,
                    lane = :lane,
                    suburb = :suburb,
                    postcode = :postcode,
                    phone = :phone,
                    email = :email,
                    age = :age,
                    gender = :gender,
                    username = :username,
                    password = :password';

            $stmt = $this->conn->prepare($query); //prepare statement

            $this->firstname = htmlspecialchars(strip_tags($this->firstname));
            $this->lastname = htmlspecialchars(strip_tags($this->lastname));
            $this->houseno = htmlspecialchars(strip_tags($this->houseno));
            $this->lane = htmlspecialchars(strip_tags($this->lane));
            $this->suburb = htmlspecialchars(strip_tags($this->suburb));
            $this->postcode = htmlspecialchars(strip_tags($this->postcode));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->gender = htmlspecialchars(strip_tags($this->gender));
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->password = htmlspecialchars(strip_tags($this->password));


            //Bind Data
            $stmt->bindParam(':firstname', $this->firstname);
            $stmt->bindParam(':lastname', $this->lastname);
            $stmt->bindParam(':houseno', $this->houseno);
            $stmt->bindParam(':lane', $this->lane);
            $stmt->bindParam(':suburb', $this->suburb);
            $stmt->bindParam(':postcode', $this->postcode);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':age', $this->age);
            $stmt->bindParam(':gender', $this->gender);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);

            //Execute
            if($stmt->execute()){
                return true;
            }

            //echo error 
            printf("ERROR: %s.\n", $stmt->error);
            return false;
       
        }

        //User Login
        public function login(){
            //Query
            $query = 'SELECT * from user WHERE user.username = ? AND user.password = ?';

            $stmt = $this->conn->prepare($query); //prepare statement
            
            //Bind
            $stmt->bindParam(1, $this->username);
            $stmt->bindParam(2, $this->password);

            //Execute
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set Properties
            $this->userid = $row['userid'];
            $this->firstname = $row['firstname'];
            $this->lastname = $row['lastname'];
            $this->houseno = $row['houseno'];
            $this->lane = $row['lane'];
            $this->suburb = $row['suburb'];
            $this->postcode = $row['postcode'];
            $this->phone = $row['phone'];
            $this->email = $row['email'];
            $this->age = $row['age'];
            $this->gender = $row['gender'];
            $this->username = $row['username'];
            $this->password = $row['password'];

    
            if($row > 0){
                return true;
            }
            return false; //user not found
        }   

    }