<?php
include 'database.inc.php';
include 'core.inc.php';
if(loggedin()==false)
{
  header("Location: index.php");
}
$out = $_SESSION['UID'];
$sql = "SELECT * FROM time WHERE UID = '$out' AND logged = '1';";
mysqli_query($conn,$sql);
$sql1 = "UPDATE time SET logged = '0', outtime = now() WHERE UID = '$out' AND logged = '1';";
mysqli_query($conn,$sql1);
header("Location:loginform.php");
session_destroy();
?>