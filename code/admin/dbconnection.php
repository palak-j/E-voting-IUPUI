<?php
$server = "localhost";
$username = "vimittal";
$password = "snowblowers cardio châtelaines masters";
$database = "vimittal_db";


// Create connection
$conn = new mysqli($server, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
{ 
	
}

?>