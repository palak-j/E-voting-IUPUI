<head>

</head>


<body>

<?php
session_start();

include 'dbconnection.php';


// getting inputs for new entry to users table
$in_code = $_POST['verif'];


if ($_SESSION['verif_code']== $in_code){

header("Location: set_password.html");


}

else{


header("Location: verification_error.html");


}




mysqli_close($conn);

?>
    
      
</body>


