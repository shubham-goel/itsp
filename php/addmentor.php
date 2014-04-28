<?php
include "dbconnect.php";
$name=mysqli_real_escape_string($con,$_POST['name']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$phone=mysqli_real_escape_string($con,$_POST['phone']);
$roll=mysqli_real_escape_string($con,$_POST['roll']);
if(isset($_POST['summer']))
	$summer="<br>".mysqli_real_escape_string($con,$_POST['summer']);
else
	$summer="";
$field=mysqli_real_escape_string($con,$_POST['field']);
$by=$_POST['by'];
$str=$name."<br>".$email."<br>".$phone."<br>".$roll.$summer;
mysqli_query($con,"update itsp_project set ".$field."='".$str."' where `by`='".$by."'");
echo $str;
?>