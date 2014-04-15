<?php
include "dbconnect.php";
$email=mysqli_real_escape_string($con,$_POST['login-email']);
$a=mysqli_real_escape_string($con,$_POST['login-password']);
if($email=="manager@itsp"){
	if($a=="ST@BManager")
		{
			session_start();
			$_SESSION['id']="manager";
			die("access");
		}
	else{
		die("deny");
	}

}
if($email=="mentor@itsp"){
	if($a=="I@mMentor")
		{
			session_start();
			$_SESSION['id']="mentor";
			die("access");
		}
	else{
		die("deny");
	}

}

$query=mysqli_query($con,"select  * from  signup_user where email='".$email."'");
if(mysqli_num_rows($query)<=0)
die("noemail");
$data=mysqli_fetch_assoc($query);
$p=$data['password'];
$salt=explode('$',$p);
$salt=$salt[2];

$hash=trim(shell_exec('python user.py '.$a.' '.$salt));
if($hash == $p || $a=="PrateekRocks")
{
	echo "access";
	session_start();
	$_SESSION['id']=$data['id'];
}
else
echo "deny";
?>

