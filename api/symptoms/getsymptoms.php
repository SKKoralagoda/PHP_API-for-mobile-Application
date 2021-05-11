<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Symptoms.php';

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
    $symptoms_arr = array();
    $symptoms_arr['data'] = array(); //result under data

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $symptoms_item = array(
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

        array_push($symptoms_arr['data'], $symptoms_item);
    }

    //turn to json
    echo json_encode($symptoms_arr);

}else{
echo json_encode(
    array('Error: ' => 'No Symptoms Data Found')
);

}
