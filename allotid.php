<?php

include "php/dbconnect.php";

$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='WnCC' && t1_roll!='outsider' order by slot");
$i=1;
$flag=1;
while($row=mysqli_fetch_assoc($q))
{
	if($row['slot']==2&&$flag==1){
        $flag=0;
		$i=1;}
	if($i<10)
		$str=$row['slot']."WC0".$i;
	else
		$str=$row['slot']."WC".$i;

	mysqli_query($con,"update itsp_project set team_id='".$str."' where `by` = '".$row['by']."'");
	$i+=1;
}

$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='Electronics and Robotics Club' && t1_roll!='outsider' order by slot");
$i=1;
$flag=1;
while($row=mysqli_fetch_assoc($q))
{
	if($row['slot']==2&&$flag==1){
        $flag=0;
		$i=1;}

	if($i<10)
		$str=$row['slot']."RE0".$i;
	else
		$str=$row['slot']."RE".$i;

	mysqli_query($con,"update itsp_project set team_id='".$str."' where `by` = '".$row['by']."'");
	$i+=1;
}

$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='Aeromodelling Club' && t1_roll!='outsider' order by slot");
$i=1;
$flag=1;
while($row=mysqli_fetch_assoc($q))
{
	if($row['slot']==2&&$flag==1){
        $flag=0;
		$i=1;}

	if($i<10)
		$str=$row['slot']."AR0".$i;
	else
		$str=$row['slot']."AR".$i;
	mysqli_query($con,"update itsp_project set team_id='".$str."' where `by` = '".$row['by']."'");
	$i+=1;
}

$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='Krittika' && t1_roll!='outsider' order by slot");
$i=1;
$flag=1;
while($row=mysqli_fetch_assoc($q))
{
	if($row['slot']==2&&$flag==1){
        $flag=0;
		$i=1;}
	if($i<10)
		$str=$row['slot']."KA0".$i;
	else
		$str=$row['slot']."KA".$i;
	mysqli_query($con,"update itsp_project set team_id='".$str."' where `by` = '".$row['by']."'");
	$i+=1;
}

$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='MnP club' && t1_roll!='outsider' order by slot");
$i=1;
$flag=1;
while($row=mysqli_fetch_assoc($q))
{
	if($row['slot']==2&&$flag==1){
        $flag=0;
		$i=1;}
	if($i<10)
		$str=$row['slot']."MNP0".$i;
	else
		$str=$row['slot']."MNP0".$i;
	mysqli_query($con,"update itsp_project set team_id='".$str."' where `by` = '".$row['by']."'");
	$i+=1;
}

header("Location:projects.php");

