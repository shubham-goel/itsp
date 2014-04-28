<?php
include "dbconnect.php";
$by=$_POST['by'];
$field=$_POST['field'];
$str=mysqli_real_escape_string($con,$_POST['comment'])."<br>added by :<by>".mysqli_real_escape_string($con,$_POST['name']);
mysqli_query($con,"update itsp_project set ".$field."='".$str."' where `by` = '".$by."'");
echo $str;
?>