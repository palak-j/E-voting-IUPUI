<?php

session_start();
include 'dbconnection.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
.enter_vote{
    visibility: hidden;
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
 <h1>IUPUI E-Voting Portal<h1><br>
</div>
<div id="page">
<div id="header">
<h1>Welcome <strong><?php echo $_SESSION['s_user']; ?></strong></h1><br>
<h2><a href="main.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a> | <a href="vote.php">Back to Polls</a></h2><br>
</div>
<h1>Current Polls</h1>


<?php 
include 'dbconnection.php'; 

$pos_id = $_POST['position_in'];
$_SESSION['pos_sel'] = $pos_id;

$sql0 = "SELECT position_name FROM positions_tbl where position_id = '$pos_id'";
$result0 = mysqli_query ($conn, $sql0);
$row0 = mysqli_fetch_assoc($result0);

$pos_title = $row0['position_name'];


echo "For: ";
echo $pos_title;

$html = "<html><table id='myTable' style='width:100%' border='1px solid black'>
    <caption style='font-weight:bold'>Candidates List</caption>
    <tr>
    <th>Candidate id</th>
    <th>Candidate Name</th>
    <th>Candidate Email</th>    
    <th>Candidate Photo</th>
    <th>Select</th>
    
    
  </tr>";

$sql2 = "SELECT candidate_id, candidate_name, candidate_email, candidate_pic FROM candidates_tbl where candidate_position = $pos_id";
$result2 = mysqli_query ($conn, $sql2);


if (mysqli_num_rows($result2) > 0) {
	 echo $row['candidate_pic'];
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result2)) {
		$pic_ref = "admin/candidates/" . $row['candidate_pic'];
		
		$html = $html."<tr><td>".$row['candidate_id']."</td><td>".$row['candidate_name']."</td><td>".$row['candidate_email']."</td><td><img src=".$pic_ref." height=100 width=100 /></td><td><input type='radio' name='checkbox' onclick='myFunction(".$row['candidate_id'].")'></td></tr>";
		
		

	    	
	    }
	} else {
	    echo "No records";
	}

	$html=$html."</table></html>";
	echo $html;


mysqli_close($conn);

?>

<script>
function myFunction(can_id_in) {

var x = document.getElementById("myTable");
var len = x.rows.length;
var res = "";



for (var i = 1; i < len; i++){

var row_can_id = x.rows[i].cells[0].innerHTML;

if (row_can_id==can_id_in){
	
	document.getElementById("cand_list").setAttribute('value', row_can_id);

	
	document.getElementById("enter_vote").style.visibility = "visible";

	
	{ break; }

}

}


}
</script>

<br><br>
<div class='enter_vote' id='enter_vote'>
<form action="cast_vote.php" method="post">
<input type="hidden" id='cand_list' name="can_sel" value="Null">
<input type="submit" name="vote" value="Cast Vote">
</form>
</div>



<?php }?>


</body>
</html>
