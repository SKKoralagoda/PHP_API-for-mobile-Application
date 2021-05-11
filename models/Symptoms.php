<?php
    class Symptoms {
        //DB
        private $conn;
        private $table = 'symptoms';

        //User Properties
        public $userid;
        public $temperature;
        public $dry_cough;
        public $sneezing;
        public $sore_throat;
        public $runny_nose;
        public $stomach_pain;
        public $diarrhea;
        public $weakness;
        public $moderate_cough;
        public $high_cough;
        public $feeling_breathless;
        public $difficult_breathless;
        public $drowsiness;
        public $chest_pain;
        public $severe_weakness;
        public $diabetes;
        public $high_dp;
        public $heart_disease;
        public $kidney_disease;
        public $lung_disorder;
        public $stroke;
        public $compromised_imu_sys;
        public $T_in_14d;
        public $T_in_hrc;
        public $contact_cnf_case;
        public $date;

        //DB symptoms Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

         //Get All Symptoms
         public function getAllSymptomsByUserID(){
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

        //Create Test
        public function createTest(){
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

        //Update Test
        public function updateTest(){
            $query = 'UPDATE ' . $this->table .'
                SET
                    temperature = :temperature,
                    dry_cough = :dry_cough,
                    sneezing = :sneezing,
                    sore_throat = :sore_throat,
                    runny_nose = :runny_nose,
                    stomach_pain = :stomach_pain,
                    diarrhea = :diarrhea,
                    weakness = :weakness,
                    moderate_cough = :moderate_cough,
                    high_cough = :high_cough,
                    feeling_breathless = :feeling_breathless,
                    difficult_breathless = :difficult_breathless,
                    drowsiness = :drowsiness,
                    chest_pain = :chest_pain,
                    severe_weakness = :severe_weakness,
                    diabetes = :diabetes,
                    high_dp = :high_dp,
                    heart_disease = :heart_disease,
                    kidney_disease = :kidney_disease,
                    lung_disorder = :lung_disorder,
                    stroke = :stroke,
                    compromised_imu_sys = :compromised_imu_sys,
                    T_in_14d = :T_in_14d,
                    T_in_hrc = :T_in_hrc,
                    contact_cnf_case = :contact_cnf_case,
                    date = :date
           
                WHERE 
                    userid = :userid';

            $stmt = $this->conn->prepare($query); //prepare statement

            $this->userid = htmlspecialchars(strip_tags($this->userid));
            $this->temperature = htmlspecialchars(strip_tags($this->temperature));
            $this->dry_cough = htmlspecialchars(strip_tags($this->dry_cough));
            $this->sneezing = htmlspecialchars(strip_tags($this->sneezing));
            $this->sore_throat = htmlspecialchars(strip_tags($this->sore_throat));
            $this->runny_nose = htmlspecialchars(strip_tags($this->runny_nose));
            $this->stomach_pain = htmlspecialchars(strip_tags($this->stomach_pain));
            $this->diarrhea = htmlspecialchars(strip_tags($this->diarrhea));
            $this->weakness = htmlspecialchars(strip_tags($this->weakness));
            $this->moderate_cough = htmlspecialchars(strip_tags($this->moderate_cough));
            $this->high_cough = htmlspecialchars(strip_tags($this->high_cough));
            $this->feeling_breathless = htmlspecialchars(strip_tags($this->feeling_breathless));
            $this->difficult_breathless = htmlspecialchars(strip_tags($this->difficult_breathless));
            $this->drowsiness = htmlspecialchars(strip_tags($this->drowsiness));
            $this->chest_pain = htmlspecialchars(strip_tags($this->chest_pain));
            $this->severe_weakness = htmlspecialchars(strip_tags($this->severe_weakness));
            $this->diabetes = htmlspecialchars(strip_tags($this->diabetes));
            $this->high_dp = htmlspecialchars(strip_tags($this->high_dp));
            $this->heart_disease = htmlspecialchars(strip_tags($this->heart_disease));
            $this->kidney_disease = htmlspecialchars(strip_tags($this->kidney_disease));
            $this->lung_disorder = htmlspecialchars(strip_tags($this->lung_disorder));
            $this->stroke = htmlspecialchars(strip_tags($this->stroke));
            $this->compromised_imu_sys = htmlspecialchars(strip_tags($this->compromised_imu_sys));
            $this->T_in_14d = htmlspecialchars(strip_tags($this->T_in_14d));
            $this->T_in_hrc = htmlspecialchars(strip_tags($this->T_in_hrc));
            $this->contact_cnf_case = htmlspecialchars(strip_tags($this->contact_cnf_case));
            $this->date = htmlspecialchars(strip_tags($this->date));

            //Bind Data
            $stmt->bindParam(':userid', $this->userid);
            $stmt->bindParam(':temperature', $this->temperature);
            $stmt->bindParam(':dry_cough', $this->dry_cough);
            $stmt->bindParam(':sneezing', $this->sneezing);
            $stmt->bindParam(':sore_throat', $this->sore_throat);
            $stmt->bindParam(':runny_nose', $this->runny_nose);
            $stmt->bindParam(':stomach_pain', $this->stomach_pain);
            $stmt->bindParam(':diarrhea', $this->diarrhea);
            $stmt->bindParam(':weakness', $this->weakness);
            $stmt->bindParam(':moderate_cough', $this->moderate_cough);
            $stmt->bindParam(':high_cough', $this->high_cough);
            $stmt->bindParam(':feeling_breathless', $this->feeling_breathless);
            $stmt->bindParam(':difficult_breathless', $this->difficult_breathless);
            $stmt->bindParam(':drowsiness', $this->drowsiness);
            $stmt->bindParam(':chest_pain', $this->chest_pain);
            $stmt->bindParam(':severe_weakness', $this->severe_weakness);
            $stmt->bindParam(':diabetes', $this->diabetes);
            $stmt->bindParam(':high_dp', $this->high_dp);
            $stmt->bindParam(':heart_disease', $this->heart_disease);
            $stmt->bindParam(':kidney_disease', $this->kidney_disease);
            $stmt->bindParam(':lung_disorder', $this->lung_disorder);
            $stmt->bindParam(':stroke', $this->stroke);
            $stmt->bindParam(':compromised_imu_sys', $this->compromised_imu_sys);
            $stmt->bindParam(':T_in_14d', $this->T_in_14d);
            $stmt->bindParam(':T_in_hrc', $this->T_in_hrc);
            $stmt->bindParam(':contact_cnf_case', $this->contact_cnf_case);
            $stmt->bindParam(':date', $this->date);


            //Execute
            if($stmt->execute()){
                return true;
            }

            //echo error 
            printf("ERROR: %s.\n", $stmt->error);
            return false;
       
        }

    }