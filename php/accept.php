<?php
include "dbconnect.php";
session_start();
if(isset($_SESSION['id']))
	$user=$_SESSION['id'];
else
	$user=false;

$manager=false;
if($user==175||$user==15||$user==56)
	$manager=true;

if($manager){
$by=$_POST['by'];
$accept=$_POST['accepter'];
if(mysqli_query($con,"update itsp_project set acceptedby='".$accept."' where `by`='".$by."'"))
	echo "accepted";
}
?>