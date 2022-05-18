
<?php
session_start();

include 'dbconnection.php';

// getting inputs for new entry to users table
$name = $_POST['name'];
$email = $_POST['email'];

$code = rand(10000,99999);

$_SESSION['verif_code'] = $code;
$_SESSION['s_email'] = $email;
$_SESSION['name'] = $name;

if (strpos($email, '@iu.edu') !== false){


$msg = "Verification code: ";

$msg = wordwrap($msg,150);

mail($email,"E- voting Verification",$code);

header('Location: verification.html');


}

else {

echo "Register with IU mail id" ;

}





mysqli_close($conn);

?>


<body>
	<p>
		<a href="reg.html">Register</a>
		</p>

</body>

