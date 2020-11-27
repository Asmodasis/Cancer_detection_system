<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/nurse.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare nurse object
$nurse = new Nurse($db);

// set ID property of nurse to be edited
$nurse->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of nurse to be edited
$stmt = $nurse->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $nurse_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "password" => $row['password'],
        "phone" => $row['phone'],
        "created" => $row['created']
    );
}
// make it json format
print_r(json_encode($nurse_arr));
?>