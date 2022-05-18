<?php
session_start();
?>
<html><head>
<link rel="stylesheet" href="style.css">
</head><body bgcolor="tan">  
<div class="h2">
 <img src="//assets.iu.edu/brand/3.2.x/trident-large.png" alt="">
 <h1>IUPUI E-Voting Admin Portal<h1><br>
</div>
<div id="page">
<div id="header">
<h1>Logged Out Successfully </h1>
<p align="center">&nbsp;</p>
</div>
<?php
session_destroy();
?>
You have been successfully logged out.<br><br><br>
Return to <a href="index.html">Login</a>

</body>
</html>