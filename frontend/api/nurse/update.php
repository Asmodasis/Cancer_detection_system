<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/nurse.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare nurse object
$nurse = new nurse($db);
 
// set nurse property values
$nurse->id = $_POST['id'];
$nurse->name = $_POST['name'];
$nurse->email = $_POST['email'];
$nurse->password = password_hash(($_POST['password']),PASSWORD_DEFAULT);
$nurse->phone = $_POST['phone'];

 
// create the nurse
if($nurse->update()){
    $nurse_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
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