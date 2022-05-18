<?php

session_start();
include 'dbconnection.php';


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
.button1 {
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
form, .content {
  width: 100%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;

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
 <h2>Manage Candidates </h2>
</div>

<form action="" method="post">
  <select id ="pos" name="Positions">
	<option value="" disabled selected>Select your option</option>

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
	
      	
    </select><br><br>
    <input type="submit" value="submit" name="button" onclick="add_c_visible()">
</form>
<?php 
include 'dbconnection.php';

if(isset($_POST['button'])){ 
 $position_in = $_POST["Positions"]; 
 $_SESSION['pos_to_modify'] = $position_in; 
 
$html = "<html><table id='myTable' style='width:100%' border='1px solid black'>
    <caption style='font-weight:bold'>Candidates List</caption>
    <tr>
    <th>Select</th>
    <th>Candidate id</th>
    <th>Candidate Name</th>
    <th>Candidate Email</th>    
    <th>Candidate Photo</th>
    
  </tr>";

$sql2 = "SELECT candidate_id, candidate_name, candidate_email, candidate_pic FROM candidates_tbl where candidate_position = $position_in";
$result2 = mysqli_query ($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result2)) {
		$pic_ref = "candidates/" . $row['candidate_pic'];
		
		$html = $html."<tr><td><input type='radio' name='checkbox' onclick='myFunction(".$row['candidate_id'].")'></td><td>".$row['candidate_id']."</td><td>".$row['candidate_name']."</td><td>".$row['candidate_email']."</td><td><img src=".$pic_ref." height=100 width=100 /></td></tr>";
		
		

	    	
	    }
	} else {
	    echo "No records";
	}

	$html=$html."</table></html>";
	echo $html;

}

$query_pos = "select position_name from positions_tbl where position_id= $position_in";
$res_pos = mysqli_query($conn, $query_pos);

$row_pos = mysqli_fetch_assoc($res_pos);
echo "<br>";




if ($row_pos["position_name"]!=""){
  echo "For: ";
  echo ($row_pos["position_name"]); ?>

<h2><a href="add_candidate.php">Add New Candidate</button></a></h2>

<?php }?>



<?php

mysqli_close($conn);


?>



<div class="form_modify" id="form_modify">

<br>

<form action="modify_candidate.php" method="post" id="form_mod">
  <label for="id">Candidate id</label>
  <input type="text" id="form_id" name="id" value="A_test">
  <label for="name">Candidate Name</label>
  <input type="text" id="form_name" name="name" value="A_test">
  <label for="email">Candidate Email</label>
  <input type="text" id="form_email" name="email" value="A_test">
  <label for="pic">Candidate Photo</label>
  <input type="text" id="form_pic" name="pic" value="A_test">
  <input type="text" id="form_position" name="position" value="<?php echo $_SESSION['pos_to_modify'] ?>" style="display: none;">
  <input type="submit" value="Modify/ Delete">
</form> 
</div>


<script>
function myFunction(can_id_in) {

var x = document.getElementById("myTable");
var len = x.rows.length;
var res = "";



for (var i = 1; i < len; i++){

var row_can_id = x.rows[i].cells[1].innerHTML;


if (row_can_id==can_id_in){

	var id_j = x.rows[i].cells[1].innerHTML;
	var name_j = x.rows[i].cells[2].innerHTML;
	var email_j = x.rows[i].cells[3].innerHTML;
 	
	
	var pic_j = x.rows[i].cells[4].innerHTML;
	
	var start_ind = pic_j.indexOf("/") + 1;
	var end_ind = pic_j.indexOf("jpg");
	
	document.getElementById("form_id").setAttribute('value', id_j);

	document.getElementById("form_name").setAttribute('value', name_j);

	document.getElementById("form_email").setAttribute('value', email_j);

	document.getElementById("form_pic").setAttribute('value', pic_j.substring(start_ind, end_ind+3));
	
	document.getElementById("form_modify").style.visibility = "visible";

	
	{ break; }

}

}


}
</script>





<?php }?>

</body>
</html>
