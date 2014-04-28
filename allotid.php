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
	$str=$row['slot']."14WC".$i;
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
	$str=$row['slot']."14RE".$i;
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
	$str=$row['slot']."14AR".$i;
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
	$str=$row['slot']."14KA".$i;
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
	$str=$row['slot']."14MNP".$i;
	mysqli_query($con,"update itsp_project set team_id='".$str."' where `by` = '".$row['by']."'");
	$i+=1;
}