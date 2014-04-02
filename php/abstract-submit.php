<?php
session_start();
if(isset($_SESSION['id']))
	$user=$_SESSION['id'];
else if (isset($_SESSION['outsider'])) {
	$user=$_SESSION['outsider'];
}
else
	die("Error .. refresh the page to continue");



$allowedExts = array("pdf");
$temp = explode(".", $_FILES["abstract"]["name"]);
$extension = end($temp);
if ($_FILES["abstract"]["size"] > 1000000)
{
	die("The file size greater than 1MB");
}
if (in_array($extension, $allowedExts)==0)
{
	die("The file extension should be pdf");
}

 if ($_FILES["abstract"]["error"] > 0)
    {
    die("Error in file upload");
    }

 if (move_uploaded_file($_FILES['abstract']['tmp_name'], "../abstract/".$user.".pdf")) {
    echo "done";
} 
else {
    echo "Possible file upload attack!\n";
}
?>
