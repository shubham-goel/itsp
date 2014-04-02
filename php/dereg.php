<?php
include "dbconnect.php";
session_start();
if(isset($_SESSION['id'])){
	mysqli_query($con,"delete from itsp_project where `by`='".$_SESSION['id']."'");

if(file_exists("../abstract/".$_SESSION['id'].".php"))
	unlink("../abstract/".$_SESSION['id'].".php");
}

if(isset($_SESSION['outsider'])){
	mysqli_query($con,"delete from itsp_project where `by`='".$_SESSION['outsider']."'");

if(file_exists("../abstract/".$_SESSION['outsider'].".php"))
	unlink("../abstract/".$_SESSION['outsider'].".php");
echo "done";
}
?>