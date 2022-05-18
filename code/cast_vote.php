<?php

session_start();
include 'dbconnection.php';
?>

<!DOCTYPE html>
<html>
<head>

</head>

<body>


<?php if(empty($_SESSION['s_user'])){
header("location:index.html");


}

if(!empty($_SESSION['s_user'])){
 
include 'dbconnection.php';

$can_sel_id = $_POST['can_sel'];
$user_id = $_SESSION['s_user'];


$sql1 = "SELECT member_id FROM members_tbl WHERE email = '$user_id'";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
	$row = mysqli_fetch_assoc($result1);
        $can_id_add = $can_sel_id;
	$member_id_add = $row['member_id'];
	$pos_id_add = $_SESSION['pos_sel'];
	
	$sql_verify = "SELECT voter_id FROM votes_tbl WHERE voter_id = '$member_id_add' AND position_id= '$pos_id_add'";
  $res2 = mysqli_query($conn, $sql_verify);

	if (mysqli_num_rows($res2) > 0) {
	echo "YOU HAVE ALREADY VOTED FOR THIS POSITION";
	header("refresh:2; url=vote.php");

	
	}
	else{
	$sql2 = "INSERT INTO votes_tbl(voter_id, position_id, candidate_id)
	VALUES ('".$member_id_add."', '".$pos_id_add."', '".$can_id_add."')";


	if (mysqli_query($conn, $sql2)) {
    		echo "Thank you for your vote";
   		 header("refresh:1.8; url=vote.php");
	} else {
    	echo "Error inserting records: " . $sql1 . "<br>" . mysqli_error($conn);
	}

	} 
	
	}
else {
	  echo "No records";
	}



}

?>



</body>
</html>
