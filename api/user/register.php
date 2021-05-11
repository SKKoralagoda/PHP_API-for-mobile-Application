<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Content-Type: application/json; charset=UTF-8");

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';
include_once '../../models/Symptoms.php';
include_once '../../models/Report.php';


//connecDB
$database = new Database();
$db = $database->connect();

$user = new User($db);
$symptoms = new Symptoms($db);
$report = new Report($db);

//get post data
$data = json_decode(file_get_contents("php://input"));

$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->houseno = $data->houseno;
$user->lane = $data->lane;
$user->suburb = $data->suburb;
$user->postcode = $data->postcode;
$user->phone = $data->phone;
$user->email = $data->email;
$user->age = $data->age;
$user->gender = $data->gender;
$user->username = $data->username;
$user->password = $data->password;


// if($user->register()){
//     //after registration login done by API

//     if($user->login()){
 
//         $user_arr = array();
//         $user_arr['data'] = array(); //result under data
        
//         //create array
//         $user_item = array(
//             'userid' => $user->userid,
//             'firstname' => $user->firstname,
//             'lastname' => $user->lastname,
//             'houseno' => $user->houseno,
//             'lane' => $user->lane,
//             'suburb' => $user->suburb,
//             'postcode' => $user->postcode,
//             'phone' => $user->phone,
//             'email' => $user->email,
//             'age' => $user->age,
//             'gender' => $user->gender
//         );
        
//             array_push($user_arr['data'], $user_item);
        
//             $symptoms->userid = $user->userid;
//             $symptoms->createTest(); //create symptoms when register

            
//             $report->userid = $user->userid;
//             $report->createTestReport(); //create report when register
            
//             //turn to json
//             echo json_encode($user_arr);
//     }

// }else{
//     echo json_encode(
//         array('Error: ' => 'User Not Registered')
//     );
// }

if($user->register()){
    echo json_encode(
        array('Success: ' => 'User Registered, Please Login')
    );
}else{
    echo json_encode(
        array('Error: ' => 'User Not Registered')
    );
}