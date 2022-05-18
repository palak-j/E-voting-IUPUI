<?php

session_start();
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
 <h1>IUPUI E-Voting Portal<h1><br>
</div>
<div id="page">
<div id="header">
<h1>Welcome <strong><?php echo $_SESSION['s_user']; ?></strong></h1><br>
<h2><a href="main.php">Home</a></button>| <a href="change_pass.php">Change Password</a>| <a href="logout.php">Logout</a></h2><br>

<button class = "button" ><a href="vote.php">View Active Polls and Cast Your Vote</a></button>
</div>


<?php }?>


</body>
</html>
