<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/nurse.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare nurse object
$nurse = new Nurse($db);
 
// set nurse property values
$nurse->id = $_POST['id'];
 
// remove the nurse
if($nurse->delete()){
    $nurse_arr=array(
        "status" => true,
        "message" => "Successfully removed!"
    );
}
else{
    $nurse_arr=array(
        "status" => false,
        "message" => "Unable to delete nurse. Please check if the nurse is linked to any patients."
    );
}
print_r(json_encode($nurse_arr));
?>