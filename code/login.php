<html>
<head>

</head>


<body>

<?php
session_start();

include 'dbconnection.php';


// getting inputs for new entry to users table
$email = $_POST['email'];
$password = $_POST['password'];



$_SESSION["s_user"] = $email;



	$sql1 = "SELECT password FROM members_tbl where email='$email'";
	$result = mysqli_query ($conn, $sql1);

	if (mysqli_num_rows($result) ==1){
 
		$r1 = mysqli_fetch_assoc($result);
		$pwd = $r1['password'];

		if ($password==$pwd){
   			header('Location: main.php');
   				}

		else{
			header('Location: login_error.html');

		    }

	    }
	else{
 		header('Location: login_error.html');
	     }

?>
    
      
</body>


</html>