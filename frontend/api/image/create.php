<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/image.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare image object
$image = new Image($db);
 
// set image property values
$image->patient_id = $_POST['patient_id'];
$image->note = $_POST['note'];
$image->cancerous = $_POST['cancerous'];
$image->url = $_POST['url'];
$image->created = date('Y-m-d H:i:s');

// create the image
if($image->create()){
    $image_arr=array(
        "status" => true,
        "message" => "Image Processed Successfully!",
        "id" => $image->id,
		"patient_id" => $image->patient_id,
		"note" => $image->note,
        "cancerous" => $image->cancerous,
		"url" => $image->url
    );
}
else{
    $image_arr=array(
        "status" => false,
        "message" => "image already exists!"
    );
}
print_r(json_encode($image_arr));
?>