<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'hospital_db');
   //Login attempt with given login credentials
   $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	
	//Check the connection
   if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>