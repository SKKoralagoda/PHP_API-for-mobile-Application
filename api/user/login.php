<?php
//Headers
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/User.php';

//connecDB
$database = new Database();
$db = $database->connect();

$user = new User($db);

//Get Username
$user->username = isset($_GET['username']) ? $_GET['username'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();

$user->login();

$user_arr = array();
$user_arr['data'] = array(); //result under data

//create array
$user_item = array(
    'userid' => $user->userid,
    'firstname' => $user->firstname,
    'lastname' => $user->lastname,
    'houseno' => $user->houseno,
    'lane' => $user->lane,
    'suburb' => $user->suburb,
    'postcode' => $user->postcode,
    'phone' => $user->phone,
    'email' => $user->email,
    'age' => $user->age,
    'gender' => $user->gender
);

    array_push($user_arr['data'], $user_item);

if($user->login()){
     //turn to json
    echo json_encode($user_arr);

}else{
    echo json_encode(
        array('Error: ' => 'Invalid Username or Password')
    );
}
