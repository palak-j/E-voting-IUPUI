

<?php
session_start();

include 'dbconnection.php';

?>


<!DOCTYPE html>
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
 <h1>IUPUI E-Voting Admin Portal<h1><br>
</div>
<div id="page">
<div id="header">
<h1>Welcome <strong><?php echo $_SESSION['s_user']; ?></strong></h1><br>
<h1>ADMINISTRATION CONTROL PANEL </h1>
<h2><a href="admin.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a> | <a href="manage_pos.php">Back to Manage positions</a></h2><br>

</div>

<div class="header">
 <h2>Enter Position Details </h2>
</div>
<form action="" method="post">
  Position name: <br>
  <input type="text" name="pos_title" required>
  <br>
  <br>
  Voters: <br>
  <input type="text" name="voters" required>
  <br>
  <br>

  Voting Deadline: <br>
  <input type="date" id="deadline" name="deadline">
  
  <br>
  <br>
   <input type="submit" value="Add Position" name="button">
</form>


<?php
include 'dbconnection.php';
if (isset($_POST['button'])) {

$pos_title = $_POST['pos_title'];
$voters = $_POST['voters'];
$deadline = $_POST['deadline'];

$sql_verify1 = "SELECT position_id FROM positions_tbl WHERE position_name = '$pos_title' AND voting_deadline >= UTC_DATE() ";
$res = mysqli_query($conn, $sql_verify1);


if (mysqli_num_rows($res) > 0){
	echo '<script>alert("This position already exist. If you want to make changes, update the details.")</script>';
	}

else{
$sql1 = "INSERT INTO positions_tbl(position_name, Voters, voting_deadline)
VALUES ('".$pos_title."', '".$voters."', '".$deadline."')";


if (mysqli_query($conn, $sql1)) {
    echo "New Position Added";
} else {
    echo "Error inserting records: " . $sql1 . "<br>" . mysqli_error($conn);
}
}
}
mysqli_close($conn);

?>

<?php }?>

</body>

</html>
