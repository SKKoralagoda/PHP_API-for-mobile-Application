<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: application/json; charset=UTF-8");

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Report.php';

//connecDB
$database = new Database();
$db = $database->connect();

$report = new Report($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

$report->userid = $data->userid;

if($report->createTestReport()){
    echo json_encode(
        array('Success: ' => 'Report Created')
    );
}else{
    echo json_encode(
        array('Error: ' => 'Report Not Created')
    );
}
