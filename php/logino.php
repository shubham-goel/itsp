<?php
include "dbconnect.php";
$email=mysqli_real_escape_string($con,$_POST['login-email']);
$a=mysqli_real_escape_string($con,$_POST['login-password']);
$query=mysqli_query($con,"select  * from  outsider_itsp where email='".$email."' && link=''");
if(mysqli_num_rows($query)<=0)
die("noemail");
$data=mysqli_fetch_assoc($query);
$p=$data['password'];

if($p == $a)
{
	echo "access";
	session_start();
	$_SESSION['outsider']=$data['email'];
}
else
echo "deny";
?>

