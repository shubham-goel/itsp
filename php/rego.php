<?php
include "dbconnect.php";
$email=mysqli_real_escape_string($con,$_POST['login-email']);
$query=mysqli_query($con,"select  * from  outsider_itsp where email='".$email."'");
if(mysqli_num_rows($query)>0)
die("deny");
$query=mysqli_query($con,"insert outsider_itsp  (email,link) values('".$email."','".md5($email)."')");
$to = $email;
$subject = "[ITSP Registration]:Activation link";
$message="Click on the following link to activate your account : <br>";
$message.="<a href='http://itsp.stab-iitb.org/outsider.php?auth=".md5($email)."'>http://itsp.stab-iitb.org/outsider.php?auth=".md5($email)."</a>";
$headers = 'From: no-reply@stab-iitb.org' . "\r\n" .
   'Reply-To: itsp2014.stab@gmail.com' . "\r\n" .
   'X-Mailer: no-reply@stab-iitb.org';
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($to,$subject,$message,$headers,'-fno-reply@stab-iitb.org');
echo "access";
?>

