<?php
$server = "localhost";
$username = "username";
$password = "password";
$database = "db_name";


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
