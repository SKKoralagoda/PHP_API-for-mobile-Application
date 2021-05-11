<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Symptoms.php';
include_once '../../models/Report.php';

//connecDB
$database = new Database();
$db = $database->connect();

$symptoms = new Symptoms($db);

//get post data
$data = json_decode(file_get_contents("php://input"));
$symptoms->userid = $data->userid;



$result = $symptoms->getAllSymptomsByUserID(); //read query

$num = $result->rowCount(); //get row count

if($num > 0){
    // $symptoms_arr = array();
    // $symptoms_arr['data'] = array(); //result under data

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $symptoms_item = array(
            'userid' => $userid,
            'temperature' => $temperature,
            'dry_cough' => $dry_cough,
            'sneezing' => $sneezing,
            'sore_throat' =>$sore_throat,
            'runny_nose' => $runny_nose,
            'stomach_pain' => $stomach_pain,
            'diarrhea' => $diarrhea,
            'weakness' => $weakness,
            'moderate_cough' => $moderate_cough,
            'high_cough' => $high_cough,
            'feeling_breathless' => $feeling_breathless,
            'difficult_breathless' => $difficult_breathless,
            'drowsiness' => $drowsiness,
            'chest_pain' => $chest_pain,
            'severe_weakness' => $severe_weakness,
            'diabetes' => $diabetes,
            'high_dp' => $high_dp,
            'heart_disease' => $heart_disease,
            'kidney_disease' => $kidney_disease,
            'lung_disorder' => $lung_disorder,
            'stroke' => $stroke,
            'compromised_imu_sys' => $compromised_imu_sys,
            'T_in_14d' => $T_in_14d,
            'T_in_hrc' => $T_in_hrc,
            'contact_cnf_case' => $contact_cnf_case
        );

        // array_push($symptoms_arr['data'], $symptoms_item);
    }
  
    // calculate Report 

    //---------------------------------------------------------------------------------
    $riskSymptoms = array_count_values($symptoms_item);
    $countY = $riskSymptoms['Y'];

    while ($s_name = current($symptoms_item)) {
        if ($s_name == 'Y') {        
            $Y_symptoms_list[] = key($symptoms_item); //save positive symptoms in Y_symptoms_list Array
        }
        next($symptoms_item);
    }
    //printf(sizeof($Y_symptoms_list));

    //find each symptom 
   
    if(!empty($countY)){

        $symptom_dry_cough = array_search('dry_cough', $Y_symptoms_list) !== false;
        $symptom_sneezing = array_search('sneezing', $Y_symptoms_list) !== false;
        $symptom_sore_throat = array_search('sore_throat', $Y_symptoms_list) !== false;
        $symptom_runny_nose = array_search('runny_nose', $Y_symptoms_list) !== false;
        $symptom_stomach_pain = array_search('stomach_pain', $Y_symptoms_list) !== false;
        $symptom_diarrhea = array_search('diarrhea', $Y_symptoms_list) !== false;
        $symptom_weakness = array_search('weakness', $Y_symptoms_list) !== false;
        $symptom_moderate_cough = array_search('moderate_cough', $Y_symptoms_list) !== false;
        $symptom_high_cough = array_search('high_cough', $Y_symptoms_list) !== false;
        $symptom_feeling_breathless = array_search('feeling_breathless', $Y_symptoms_list) !== false;
        $symptom_difficult_breathless = array_search('difficult_breathless', $Y_symptoms_list) !== false;
        $symptom_drowsiness = array_search('drowsiness', $Y_symptoms_list) !== false;
        $symptom_chest_pain = array_search('chest_pain', $Y_symptoms_list) !== false;
        $symptom_severe_weakness = array_search('severe_weakness', $Y_symptoms_list) !== false;
        $symptom_diabetes = array_search('diabetes', $Y_symptoms_list) !== false;
        $symptom_high_dp = array_search('high_dp', $Y_symptoms_list) !== false;
        $symptom_heart_disease = array_search('heart_disease', $Y_symptoms_list) !== false;
        $symptom_kidneyDisease = array_search('kidney_disease', $Y_symptoms_list) !== false;
        $symptom_lungDisorder = array_search('lung_disorder', $Y_symptoms_list) !== false;
        $symptom_stroke = array_search('stroke', $Y_symptoms_list) !== false;
        $symptom_compromised_imu_sys = array_search('compromised_imu_sys', $Y_symptoms_list) !== false;
        $symptom_T_in_14d = array_search('T_in_14d', $Y_symptoms_list) !== false;
        $symptom_T_in_hrc = array_search('T_in_hrc', $Y_symptoms_list) !== false;
        $symptom_contact_cnf_case = array_search('contact_cnf_case', $Y_symptoms_list) !== false;

    }
    //---------------------------------------------------------------------------------
    

    //======================= Calculattion - Start ===============================================
   
if(empty($countY)){ //no any symptoms
    $riskMeter = 0;
}

if(!empty($countY)){ //there are symptoms

     //normal temp
    if(37 >= $temperature){ 
        
        if($countY == 1){ //any 1 symptom
            $riskMeter = 0; // 1 symptom 

            if(($symptom_high_dp == 1) || ($symptom_diabetes == 1)){ 
                $riskMeter = 1;  //1 symptom - high_dp OR diabetes
            }

            if(($symptom_dry_cough == 1)){ 
                $riskMeter = 2; // 1 symptom - dry_cough
            }
            
        }

        if($countY <= 2){ //less than 2 symptoms
            $riskMeter = 1;
        }

        if($countY >= 2){ //any 2 or more symptom
      
            if(($symptom_dry_cough == 1) && ($symptom_diabetes == 1)){ 
                $riskMeter = 3;  //2 symptoms - dry_cough AND diabetes 
            }

            if(($symptom_dry_cough == 1) && ($symptom_weakness == 1)){ 
                $riskMeter = 3;  //2 symptoms - dry_cough AND weakness
            }

        }

        if($countY >= 4){ //any 4 or more symptom

            if(($symptom_moderate_cough == 1) && ($symptom_chest_pain == 1) && ($symptom_kidneyDisease == 1) && ($symptom_lungDisorder == 1)){
                $riskMeter = 3;  //4 symptoms - moderate_cough AND chest_pain AND kidney_disease AND lung_disorder
            }

            if(($symptom_dry_cough == 1) && ($symptom_feeling_breathless == 1) && ($symptom_stroke == 1) && ($symptom_compromised_imu_sys == 1)){
                $riskMeter = 3;  //4 symptoms - dry_cough AND feeling_breathless AND stroke AND compromised_imu_sys
            }
        }

        if($countY > 5){ //more than 5 symptom
            $riskMeter = 4;
        }


        
    }
    //normal temp - End


    //High temp
    if(37 < $temperature){ 
    
        if($countY == 1){ 
            $riskMeter = 1; //any 1 symptoms with high temp

            if($symptom_feeling_breathless == 1){ 
                $riskMeter = 4; // 1 symptom - feeling_breathless with high Temp
            }
        }

        if($countY > 1){ 
            $riskMeter = 2; //any 1-3 symptoms with high temp

            if(($symptom_feeling_breathless == 1)){ 
                $riskMeter = 4; // 1 symptom - feeling_breathless with high Temp
            }
        }


        if($countY >= 4){ //any 4 or more symptom

            if(($symptom_sneezing == 1) && ($symptom_sore_throat == 1) && ($symptom_stomach_pain == 1) && ($symptom_diarrhea == 1)){
                $riskMeter = 5;  //4 symptoms - moderate_cough AND chest_pain AND kidney_disease AND lung_disorder
            }
        }

        if($countY > 5){ //more than 5 symptom
            $riskMeter = 5;
        }

    }
    //High temp - End

    if(($symptom_T_in_14d == 1 || $symptom_T_in_hrc == 1 || $symptom_contact_cnf_case == 1)){ 
        $riskMeter = 6; // symptoms - with symptom_T_in_14d or symptom_T_in_hrc or symptom_T_in_hrc
    }
}

    //======================= Calculattion -END =========================================================

    //risk meter outPut for tetsing
    //echo json_encode($riskMeter); 

    //risk meter 
    if($riskMeter == 0){
        $risk_from_cal = '0';
        $recommended_from_cal = 'Looking safe. Take Care!';
    }

    if($riskMeter == 1){
        $risk_from_cal = '1';
        $recommended_from_cal = 'Do self quarantine. Take Care!';
    }

    if($riskMeter == 2){
        $risk_from_cal = '2';
        $recommended_from_cal = 'Do self quarantine. Follow safety procedures against Covid-19';
    }

    if($riskMeter == 3){
        $risk_from_cal = '3';
        $recommended_from_cal = 'Having modesafe symptom need to take care and take medicine';
    }

    if($riskMeter == 4){
        $risk_from_cal = '4';
        $recommended_from_cal = 'Take medicine and consult nearby doctor';
    }

    if($riskMeter == 5){
        $risk_from_cal = '5';
        $recommended_from_cal = 'Need to consult a doctor immediately and take treatment for covid-19';
    }

    if($riskMeter == 6){
        $risk_from_cal = '6';
        $recommended_from_cal = 'Need to consult a doctor immediately and take treatment for covid-19';
    }
    //risk meter 

    //update report according to risk analysis------------------------------------------------------------
    $report = new Report($db);
    
    //set userid to update
    $report->userid = $data->userid;
    $report->risk = $risk_from_cal;
    $report->recommended = $recommended_from_cal;

    if($report->updateTestReport()){
        echo json_encode(
            array('Success: ' => 'Report Generated. Please find your report at result page')
        );
    }else{
        echo json_encode(
            array('Error: ' => 'Report not generated')
        );
    }
    //update report according to risk analysis------------------------------------------------------------

}






