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
$nurse->name = $_POST['name'];
$nurse->email = $_POST['email'];
$nurse->password = base64_encode($_POST['password']);
$nurse->phone = $_POST['phone'];
$nurse->created = date('Y-m-d H:i:s');

// create the nurse
if($nurse->create()){
    $nurse_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $nurse->id,
        "name" => $nurse->name,
        "email" => $nurse->email,
        "phone" => $nurse->phone
    );
}
else{
    $nurse_arr=array(
        "status" => false,
        "message" => "Name already exists!"
    );
}
print_r(json_encode($nurse_arr));
?>