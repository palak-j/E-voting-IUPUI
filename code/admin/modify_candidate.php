<?php
session_start();

include 'dbconnection.php';

?>

<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
li {
  display: inline-block;
  margin: 0 10px;
}


</style>

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
 <h2>Current Details </h2>
</div>
<?php


// getting inputs for new entry to users table
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$pic = $_POST['pic'];
$position = $_POST['position'];

$_SESSION['mod_id']=$id;


echo "<p style='color: Green; text-align: center; font-weight: bold;'> Candidate Name: $name </p>";  
echo "<p style='color: Green; text-align: center; font-weight: bold;'> Candidate Email: $email </p>"; 
echo "<p style='color: Green; text-align: center; font-weight: bold;'> Candidate Picture: $pic </p>"; 
?>

<form action="delete_candidate.php" method="post">
<input type="submit" name="delete_can" value="Delete Candidate">
</form>


<div class="header">
 <h2>Update Details </h2>
</div>
<form action="update_cand.php" method="post">
  Full Name: <br>
  <input type="text" name="new_name" value="<?php echo $name ?>">
  <br>
  <br>
  IU Email id: <br>
  <input type="text" name="new_email" value="<?php echo $email ?>">
  <br>
  <br>
  Candidate Photo: <br>
  <input type="text" name="new_pic" value="<?php echo $pic ?>">
  <br>
  <br>
   <input type="submit" value="Update" name="button_mod">
</form>



<?php }?>
</body>



</html>