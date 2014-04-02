<?php
include "dbconnect.php";
$email=mysqli_real_escape_string($con,$_POST['login-email']);
$a=mysqli_real_escape_string($con,$_POST['login-password']);
$query=mysqli_query($con,"select  * from  signup_user where email='".$email."'");
if(mysqli_num_rows($query)<=0)
die("noemail");
$data=mysqli_fetch_assoc($query);
$p=$data['password'];
$salt=explode('$',$p);
$salt=$salt[2];

$hash=trim(shell_exec('python user.py '.$a.' '.$salt));
if($hash == $p)
{
	echo "access";
	session_start();
	$_SESSION['id']=$data['id'];
}
else
echo "deny";
?>

