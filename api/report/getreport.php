<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/Report.php';

//connecDB
$database = new Database();
$db = $database->connect();

$report = new Report($db);

//get post data
$data = json_decode(file_get_contents("php://input"));
$report->userid = $data->userid;


$result = $report->getReportbyUserID(); //read query

$num = $result->rowCount(); //get row count

if($num > 0){
    $report_arr = array();
    $report_arr['data'] = array(); //result under data

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $report_item = array(
            'userid' => $userid,
            'risk' => $risk,
            'recommended' => $recommended
        );

        array_push($report_arr['data'], $report_item);
    }

    //turn to json
    echo json_encode($report_arr);

}else{
echo json_encode(
    array('Error: ' => 'No Report Data Found')
);

}
