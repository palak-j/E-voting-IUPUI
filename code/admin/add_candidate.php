

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
<h2><a href="admin.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a> | <a href="manage_cand.php">Back to Manage Candidates</a></h2><br>

</div>


<div class="header">
 <h2>Enter Candidate Details </h2>
</div>
<form action="" method="post">
  Full Name: <br>
  <input type="text" name="candidate_name" required>
  <br>
  <br>
  IU Email id: <br>
  <input type="text" name="email" required>
  <br>
  <br>

  Candidate Position: <br>
  <select id ="pos" name="position">
  <?php
	$query = "select position_id, position_name from positions_tbl where voting_deadline >= UTC_DATE()";
	$res = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_assoc($res)){
	?>
	
	<option value="<?php echo strval($row["position_id"]);
			?>"> <?php echo $row["position_name"];
		 ?> </option>
	<?php 
	}?>
	</select>
  <br>
  <br>
  Candidate Photo: <br>
  <input type="text" name="candidate_pic" required>
  <br>
  <br>
   <input type="submit" value="Add Candidate" name="button">
</form>


<?php

if (isset($_POST['button'])) {
	
$name = $_POST['candidate_name'];
$email = $_POST['email'];

$position = $_POST['position'];
$pic = $_POST['candidate_pic'];
$vote_cn = 0;

$sql_verify1 = "SELECT candidate_id FROM candidates_tbl WHERE candidate_email = '$email' AND candidate_position='$position'";
$res = mysqli_query($conn, $sql_verify1);


if (mysqli_num_rows($res) > 0){
	echo '<script>alert("This candidate already exist for specified position. If you want to make changes, update the details.")</script>';
	}

else{

$sql1 = "INSERT INTO candidates_tbl(candidate_name, candidate_email,candidate_position, candidate_pic, candidate_cvotes)
VALUES ('".$name."', '".$email."', '".$position."', '".$pic."', '".$vote_cn."')";


if (mysqli_query($conn, $sql1)) {
    echo "New Candidate Added";
    

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
