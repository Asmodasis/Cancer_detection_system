<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/image.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare image object
$image = new Image($db);
 
// query image
$stmt = $image->read($_GET['id']);
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // images array
    $images_arr=array();
    $images_arr["images"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $image_item=array(
            "id" => $id,
            "patient_id" => $patient_id,
            "note" => $note,
            "cancerous" => $cancerous,
            "url" => $url,
            "created" => $created
        );
        array_push($images_arr["images"], $image_item);
    }
 
    echo json_encode($images_arr["images"]);
}
else{
    echo json_encode(array());
}
?>