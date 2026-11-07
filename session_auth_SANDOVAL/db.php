<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "auth_demo";

$conn = mysqli_connect($host, $username, $password, $db_name);

if($conn->connect_error){
   die("Database Connection Failed: " . $conn->connect_error); 
   }
echo "Connected Successfully";

?>