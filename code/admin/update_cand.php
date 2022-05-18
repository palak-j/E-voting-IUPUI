<?php

session_start();

include 'dbconnection.php';

if(empty($_SESSION['s_user'])){
header("location:index.html");
}

if(!empty($_SESSION['s_user'])){

if(isset($_POST['button_mod'])){ 

$new_name = $_POST['new_name'];
$new_email = $_POST['new_email'];
$new_pic = $_POST['new_pic'];

$sql_update = "UPDATE candidates_tbl SET candidate_name='".$new_name."', candidate_email='".$new_email."', candidate_pic='".$new_pic."' WHERE candidate_id='".$_SESSION['mod_id']."'";

if (mysqli_query($conn, $sql_update)) {
  echo "Updating ....";
  header("refresh:0.8; url=manage_cand.php");
} else {
  echo "Error updating record: " . $conn->error;
}


}
}
?>
