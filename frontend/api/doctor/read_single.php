<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare patient object
$patient = new Patient($db);

// set ID property of patient to be edited
$patient->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of patient to be edited
$stmt = $patient->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $patient_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
		"phone" => $row['phone'],
        "health_condition" => $row['health_condition'],
		"doctor_id" => $row['doctor_id'],
		"nurse_id" -> $row['nurse_id],
        "created" => $row['created']
    );
}
// make it json format
print_r(json_encode($patient_arr));
?>