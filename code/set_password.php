<?php
session_start();

include 'dbconnection.php';


// getting inputs for new entry to users table
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$password = $_POST['password'];
$crf_password = $_POST['crf_password'];
$is_student = $_POST['is_student'];
$is_employee = $_POST['is_employee'];
$email = $_SESSION['s_email'];


$sql = "SELECT password FROM members_tbl where email='$email'";
$result = mysqli_query ($conn, $sql);

if (mysqli_num_rows($result) ==1){

echo "Email already exist. Try to log in.";
echo "<br><a href='index.html'>Log in</a>";

}
else
{

if($password == $crf_password){


$sql2 = "INSERT INTO members_tbl(first_name, last_name, is_student,is_employee, email, password)
VALUES ('".$f_name."', '".$l_name."', '".$is_student."', '".$is_employee."','".$email."', '".$password."' )";

if (mysqli_query($conn, $sql2)) {
    
echo "Registered";
echo "<br><a href='index.html'>Log in</a>";

// remove all session variables
session_unset();

// destroy the session
session_destroy();


} else {
    echo "Error inserting records: " . $sql2 . "<br>" . mysqli_error($conn);
}

}

else{
header('Location: set_password_error.html');

}
}
mysqli_close($conn);





?>
<body>
</body>
