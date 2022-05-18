<?php

session_start();
include 'dbconnection.php';


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
.button {
  border: none;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 15px 2px;
  cursor: pointer;
}

td img{
    display: block;
    margin-left: auto;
    margin-right: auto;

}

.form_modify{
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
 <h1>IUPUI E-Voting Admin Portal<h1><br>
</div>
<div id="page">
<div id="header">
<h1>Welcome <strong><?php echo $_SESSION['s_user']; ?></strong></h1><br>
<h1>ADMINISTRATION CONTROL PANEL </h1>
<h2><a href="admin.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a></h2><br>

</div>


<div class="header">
 <h2>Results</h2>
</div>
<form action="" method="post">
  <select id ="pos" name="Positions">
	<option value="" disabled selected>Select your option</option>

     <?php
	$query = "select position_id, position_name from positions_tbl where voting_deadline <= UTC_DATE()";
	$res = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_assoc($res)){
	?>
	
	<option value="<?php echo strval($row["position_id"]);
			?>"> <?php echo $row["position_name"];
		 ?> </option>
	<?php 
	}?>
	
    </select><br><br>
    <input type="submit" value="submit" name="button" onclick="add_c_visible()">
</form>

<?php 
include 'dbconnection.php';

if(isset($_POST['button'])){

	$position_in = $_POST["Positions"];
	
    $html = "<html><table id='myTable' style='width:80%' border='1px solid black'>
    <caption style='font-weight:bold'>Candidates List</caption>
    <tr>
    <th>Position</th>
    <th>Candidate id</th>
    <th>Candidate Name</th>
    <th>Candidate Email</th>    
    <th>Candidate Photo</th>
    <th>Vote Counts</th>
    </tr>";

	$sql2 = "SELECT P.position_name as Position, C.candidate_id Candidate_Id , candidate_name as Candidate_Name, candidate_email as Candidate_Email, candidate_pic as Candidate_Picture, B.Number_of_votes as Vote_Count FROM candidates_tbl C
INNER JOIN (SELECT candidate_id, position_id,COUNT(voter_id) AS Number_of_votes FROM votes_tbl GROUP BY position_id,candidate_id) B 
ON C.candidate_id= B.candidate_id INNER JOIN positions_tbl P ON B.position_id=P.position_id WHERE P.position_id='$position_in' order by Vote_Count Desc";
	$result2 = mysqli_query ($conn, $sql2);
	
	if (mysqli_num_rows($result2) > 0) {
		
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result2)) {
		$pic_ref = "candidates/" . $row['Candidate_Picture'];
		
		$html = $html."<tr><td>".$row['Position']."</td><td>".$row['Candidate_Id']."</td><td>".$row['Candidate_Name']."</td><td>".$row['Candidate_Email']."</td><td><img src=".$pic_ref." height=100 width=100 /></td><td>".$row['Vote_Count']."</td></tr>";
		
		

	    	
	    }
	} else {
	    echo "No records";
	}

	$html=$html."</table></html>";
	echo $html;

}




mysqli_close($conn);


?>






<?php }?>

</body>
</html>
