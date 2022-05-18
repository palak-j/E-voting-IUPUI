<?php

session_start();
include 'dbconnection.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<style>

.check_list{
    visibility: hidden;
}


</style></head>

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
<h2><a href="main.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a></h2><br>
</div>

<h1>Current Polls</h1><br>


<?php 
include 'dbconnection.php';

$html = "<html><table id='Table1' style='width:100%' border='1px solid black'>
    <caption style='font-weight:bold'>Active Election Positions</caption>
    <tr>
    <th>Id</th>
    <th>Position</th>
    <th>Available for</th>
    <th>Voting Deadline</th>
    <th>Select</th>
    
  </tr>";


$sql_user = "SELECT is_student, is_employee FROM members_tbl where email = '$user' ";
$res = mysqli_query ($conn, $sql_user);
$row_user = mysqli_fetch_assoc($res);



$stat1 = $row_user['is_student'];
$stat2 = $row_user['is_employee'];



if ($stat1 =='Yes'){
$stat1 = 'S';
}
if ($stat2=='Yes'){
$stat2 = 'E';
}



$sql1 = "SELECT position_id,position_name, Voters, voting_deadline FROM positions_tbl where voting_deadline >= UTC_DATE() AND (Voters='$stat1' or Voters='$stat2' or Voters='A')";
$result = mysqli_query ($conn, $sql1);


if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
		
	    	$html = $html."<tr><td>".$row['position_id']."</td><td>".$row['position_name']."</td><td>".$row['Voters']."</td><td>".$row['voting_deadline']."</td><td><input type='radio' name='checkbox' onclick='myFunction(".$row['position_id'].")'></td></tr>";
			
	    }
	} else {
	    echo "No records";
	}
	
		$html=$html."</table></html>";
		echo $html;

mysqli_close($conn);

?>

<div class='check_list' id='check_list'>
<form action="see_candidates.php" method="post">
<input type="hidden" id='cand_list' name="position_in" value="Null">
<input type="submit" name="candidates_list" value="         Click to View Eligible Candidates for the position      ">
</form>
</div>



<script>
function myFunction(can_id_in) {

var x = document.getElementById("Table1");
var len = x.rows.length;
var res = "";


for (var i = 1; i < len; i++){

var row_can_id = x.rows[i].cells[0].innerHTML;


if (row_can_id==can_id_in){

	var id_j = x.rows[i].cells[1].innerHTML;
	document.getElementById("check_list").style.visibility = "visible";
	document.getElementById("cand_list").setAttribute('value', can_id_in);

	{ break; }

}
}
}

</script>

<?php }?>


</body>
</html>
