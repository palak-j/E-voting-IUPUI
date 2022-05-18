<?php
session_start();

include 'dbconnection.php';

?>

<html>
<head>
<link rel="stylesheet" href="style.css">

</head>


<body>


<?php if(empty($_SESSION['s_user'])){
header("location:index.html");

}?>


<?php if(!empty($_SESSION['s_user'])){?>


<div class="h2">
 <img src="//assets.iu.edu/brand/3.2.x/trident-large.png" alt="">
 <h1>IUPUI E-Voting Portal<h1><br>
</div>
<div id="page">
<div id="header">
<h1>Welcome <strong><?php echo $_SESSION['s_user']; ?></strong></h1><br>
<h1>ADMINISTRATION CONTROL PANEL </h1>
<h2><a href="admin.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a></h2><br>
</div>

<br><br>

<form action="" method="post">
<input type="text" name="current_password" placeholder="Current password" required><br><br>
<input type="text" name="new_password" placeholder="New password" required><br><br>
<input type="text" name="confirm_new_password" placeholder="Confirm password" required><br><br>
<input type="submit" name="change_password" placeholder="Update">
</form>



<?php


// getting inputs for new entry to users table
$current = $_POST['current_password'];
$new = $_POST['new_password'];
$cnfrm_new = $_POST['confirm_new_password'];

if(isset($_POST['change_password'])){ 
 
$sql_check = "SELECT password from admin_tbl WHERE email='".$_SESSION['s_user']."' AND password='".$current."' ";

$result = mysqli_query ($conn, $sql_check);

if (mysqli_num_rows($result) > 0) {

if(($new==$cnfrm_new)){

$sql_update = "UPDATE admin_tbl SET password='".$new."' WHERE email='".$_SESSION['s_user']."'";

if (mysqli_query($conn, $sql_update)) {
  echo "Password Updated";
} else {
  echo "Error updating record: " . $conn->error;
}

}
else{

echo "Passwords do not match";

}
}
else{
echo "Wrong current password";

}
}


mysqli_close($conn);

?>
<?php }?>
</body>



</html>