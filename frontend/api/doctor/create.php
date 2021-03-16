<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare doctor object
$doctor = new Doctor($db);
 
// set doctor property values
$doctor->name = $_POST['name'];
$doctor->email = $_POST['email'];
$doctor->password = password_hash(($_POST['password']),PASSWORD_DEFAULT);
$doctor->created = date('Y-m-d H:i:s');

// create the doctor
if($doctor->create()){
    $doctor_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $doctor->id,
        "name" => $doctor->name,
        "email" => $doctor->email,
        "phone" => $doctor->phone,
        "specialist" => $doctor->specialist
    );
}
else{
    $doctor_arr=array(
        "status" => false,
        "message" => "Name already exists!"
    );
}
print_r(json_encode($doctor_arr));
?>