<?php

session_start();
include 'dbconnection.php';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<style>
.form_modify{
    visibility: hidden;
}

.update_form{
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
</style></head>

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
<h2><a href="admin.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a></h2>

</div>
<div class="header">
 <h2>Manage Positions </h2>
</div>

<h2><a href="add_position.php">Add New Position</a></h2>



<?php 
include 'dbconnection.php';

$html = "<html><table id='Table1' style='width:100%' border='1px solid black'>
    <caption style='font-weight:bold'>Active Election Positions</caption>
    <tr>
    <th>Id</th>
    <th>Position</th>
    <th>Available for</th>
    <th>Voting Deadline</th>
    <th>Select to Update</th>
    
  </tr>";


$sql1 = "SELECT position_id,position_name, Voters, voting_deadline FROM positions_tbl where voting_deadline >= UTC_DATE()";
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
<div class="form_modify" id="form_modify_pos">
</div>

<div class="update_form" id="update_form">
<form action="" method="post" id="form_mod_pos">
  <label for="in_id">Position id</label>
  <input type="text" id="in_id" name="in_id" value="A_test">
  <label for="title">Position Title</label>
  <input type="text" id="form_title" name="title" value="A_test">
  <label for="availability">Voting available for</label>
  <input type="text" id="form_available" name="availability" value="A_test">
  <label for="deadline">Deadline</label>
  <input type="text" id="form_deadline" name="deadline" value="A_test">
  <input type="submit" name="update_button" value="Update" />
  <input type="submit" name="delete_button" value="Delete" />
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
        var id_f = x.rows[i].cells[0].innerHTML;
	var title = x.rows[i].cells[1].innerHTML;
	var avab = x.rows[i].cells[2].innerHTML;
	var deadline = x.rows[i].cells[3].innerHTML;

	
document.getElementById("update_form").style.visibility = "visible";

document.getElementById("form_modify_pos").style.visibility = "visible";
document.getElementById("form_title").setAttribute('value', title);

document.getElementById("form_available").setAttribute('value', avab);

document.getElementById("form_deadline").setAttribute('value', deadline);
document.getElementById("in_id").setAttribute('value', id_f);




{ break; }

}
}
}

</script>




<?php 
include 'dbconnection.php';

$html = "<html><table style='width:100%' border='1px solid black'>
    <caption style='font-weight:bold'>Past Election Positions</caption>
    <tr>
    <th>Id</th>
    <th>Position</th>
    <th>Available for</th>
    <th>Voting Deadline</th>
    
  </tr>";


$sql1 = "SELECT position_id, position_name, Voters, voting_deadline FROM positions_tbl where voting_deadline < UTC_DATE()";
$result = mysqli_query ($conn, $sql1);


if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
		
	    	$html = $html."<tr><td>".$row['position_id']."</td><td>".$row['position_name']."</td><td>".$row['Voters']."</td><td>".$row['voting_deadline']."</td></tr>";
			
	    }
	} else {
	    echo "No records";
	}
	
		$html=$html."</table></html>";
		echo $html;



?>

<?php 

if (isset($_POST['update_button'])) {
     $pos_id = $_POST['in_id']; 
     $title = $_POST['title'];
     $avab = $_POST['availability'];
     $deadline = $_POST['deadline'];     

     $sql_update = "UPDATE positions_tbl SET position_name='".$title."', Voters='".$avab."'	, voting_deadline='".$deadline."' WHERE position_id='".$pos_id."'";

     if (mysqli_query($conn, $sql_update)) {
        echo "Updating ....";
     header("refresh:0.8; url=manage_cand.php");
         } else {
     echo "Error updating record: " . $conn->error;
     }


    //update action
} else if (isset($_POST['delete_button'])) {
    //delete action
    $pos_id = $_POST['in_id'];

     $sql1 = "DELETE FROM positions_tbl WHERE position_id=$pos_id";

     if (mysqli_query($conn, $sql1)) {
       echo "Deleting ....";
       header("refresh:0.8; url=manage_pos.php");
     } else {
       echo "Error inserting records: " . $sql1 . "<br>" . mysqli_error($conn);
}


} else {
    //no button pressed
}

mysqli_close($conn);

?>

<?php }?>


</body>
</html>
