<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Symptoms.php';

//connecDB
$database = new Database();
$db = $database->connect();

$symptoms = new Symptoms($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

//set userid to update
$symptoms->userid = $data->userid;
$symptoms->temperature = $data->temperature;

$symptoms->dry_cough = $data->dry_cough;
$symptoms->sneezing = $data->sneezing;
$symptoms->sore_throat = $data->sore_throat;
$symptoms->runny_nose = $data->runny_nose;

$symptoms->stomach_pain = $data->stomach_pain;
$symptoms->diarrhea = $data->diarrhea;
$symptoms->weakness = $data->weakness;
$symptoms->moderate_cough = $data->moderate_cough;

$symptoms->high_cough = $data->high_cough;
$symptoms->feeling_breathless = $data->feeling_breathless;
$symptoms->difficult_breathless = $data->difficult_breathless;
$symptoms->drowsiness = $data->drowsiness;

$symptoms->chest_pain = $data->chest_pain;
$symptoms->severe_weakness = $data->severe_weakness;
$symptoms->diabetes = $data->diabetes;
$symptoms->high_dp = $data->high_dp;

$symptoms->heart_disease = $data->heart_disease;
$symptoms->kidney_disease = $data->kidney_disease;
$symptoms->lung_disorder = $data->lung_disorder;
$symptoms->stroke = $data->stroke;

$symptoms->compromised_imu_sys = $data->compromised_imu_sys;
$symptoms->T_in_14d = $data->T_in_14d;
$symptoms->T_in_hrc = $data->T_in_hrc;
$symptoms->contact_cnf_case = $data->contact_cnf_case;

$symptoms->date = $data->date;


if($symptoms->updateTest()){
    echo json_encode(
        array('Success: ' => 'Answers are saved')
    );
}else{
    echo json_encode(
        array('Error: ' => 'Test not updated')
    );
}
