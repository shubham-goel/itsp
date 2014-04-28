<?php
include "dbconnect.php";
$fileds1=array('email','name','contact','password','college','year','link');
$field="(";
$value="(";
	foreach ($fileds1 as $key ) {
		if(isset($_POST[$key])){
			if($field!="("){
				$field.=",";
				$value.=",";
			}
			$field.="`".$key."`";
			$value.="'".mysqli_real_escape_string($con,$_POST[$key])."'";
		}
	}
	$field.=")";
	$value.=")";
$q=mysqli_query($con,"select *  from outsider_itsp where email='".$_POST['email']."'");
if(mysqli_num_rows($q)>0)
	die("email-error");
mysqli_query($con,"insert into outsider_itsp ".$field." values ".$value);
session_start();
$_SESSION['outsider']=$_POST['email'];
?>
