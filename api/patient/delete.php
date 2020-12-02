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
$patient->id = $_POST['id'];
 
// remove the patient
if($patient->delete()){
    $patient_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $patient_arr=array(
        "status" => false,
        "message" => "Patient Cannot be deleted. Please contact admin."
    );
}
print_r(json_encode($patient_arr));
?>