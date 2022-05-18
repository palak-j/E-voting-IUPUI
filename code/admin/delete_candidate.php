<?php
session_start();

include 'dbconnection.php';

if(empty($_SESSION['s_user'])){
header("location:index.html");
}

if(!empty($_SESSION['s_user'])){


$id = $_SESSION['mod_id'];


$sql1 = "DELETE FROM candidates_tbl WHERE candidate_id=$id";

if (mysqli_query($conn, $sql1)) {
    echo "Deleting ....";
    header("refresh:0.8; url=manage_cand.php");
} else {
    echo "Error inserting records: " . $sql1 . "<br>" . mysqli_error($conn);
}



}
mysqli_close($conn);
?>
