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

if($user=='manager')
	$manager=true;

if($manager){
$by=$_POST['by'];
$accept=$_POST['field'];
echo "update itsp_project set ".$accept."='' where `by`='".$by."'";
if(mysqli_query($con,"update itsp_project set ".$accept."='' where `by`='".$by."'"))
	echo "accepted";
}
?>