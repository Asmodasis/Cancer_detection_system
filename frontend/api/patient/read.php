<?php
// Initialize the session
session_start();
// Include config file
require "../../config.php";

// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
// query patient
$stmt = $patient->read($_SESSION['id'], $_SESSION['role']);
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // patients array
    $patients_arr=array();
    $patients_arr["patients"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $patient_item=array(
            "id" => $id,
            "name" => $name,
			"phone" => $phone,
			"gender" => $gender,
            "health_condition" => $health_condition,
            "doctor_id" => $doctor_id,
            "nurse_id" => $nurse_id,
            "created" => $created
        );
        array_push($patients_arr["patients"], $patient_item);
    }
 
    echo json_encode($patients_arr["patients"]);
}
else{
    echo json_encode(array());
}
?>