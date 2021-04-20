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

$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // nurses array
    $nurses_arr=array();
    $nurses_arr["nurses"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $nurse_item=array(
            "id" => $id,
            "name" => $name,
			"email" => $email,
            "password" => $password,
			"phone" => $phone,
            "created" => $created
        );
        array_push($nurses_arr["nurses"], $nurse_item);
    }
 
    echo json_encode($nurses_arr["nurses"]);
}
else{
    echo json_encode(array());
}
?>