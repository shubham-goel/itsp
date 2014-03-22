<?php
include "dbconnect.php";
$a="9431221178";
$email="prateekchandan@iitb.ac.in";
$email=$_GET['email'];
$a=$_GET['pass'];
$query=mysqli_query($con,"select  * from  signup_user where email='".$email."'");
if(mysqli_num_rows($query)<=0)
die("noemail");
$data=mysqli_fetch_assoc($query);
$p=$data['password'];
echo $p."<br>";
$salt=explode('$',$p);
$salt=$salt[2];

$hash=trim(shell_exec('python user.py '.$a.' '.$salt));
echo $hash."<br>";
if($hash == $p)
{
	echo "access";
	session_start();
	$_SESSION['id']=$data['id'];
}
else
echo "deny";
?>

