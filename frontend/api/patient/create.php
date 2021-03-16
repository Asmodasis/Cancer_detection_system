<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);
 
// set patient property values
$patient->name = $_POST['name'];
$patient->phone = $_POST['phone'];
$patient->gender = $_POST['gender'];
$patient->health_condition = $_POST['health_condition'];
$patient->doctor_id = $_POST['doctor_id'];
$patient->nurse_id = $_POST['nurse_id'];
$patient->created = date('Y-m-d H:i:s');

// create the patient
if($patient->create()){
    $patient_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $patient->id,
		"name" => $patient->name,
		"phone" => $patient->phone,
        "gender" => $patient->gender,
		"health_condition" => $patient->health_condition,
		"doctor_id" => $patient->doctor_id,
		"nurse_id" => $patient->nurse_id
    );
}
else{
    $patient_arr=array(
        "status" => false,
        "message" => "Patient already exists!"
    );
}
print_r(json_encode($patient_arr));
?>