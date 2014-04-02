<?php
include "dbconnect.php";
if(isset($_POST['umic'])){
$fields=array("project_name","by","club","project_desc","t1_name","t1_email","t1_roll","t1_contact","t1_hostel","t2_name");
switch ($_POST['project_name']) {
	case 'Snake Robot':
		$_POST['project_desc']="Snakes have the ability to handle rugged terrains and manoeuvre through natural obstacles easily";
		break;
	case 'Indoor Navigation and Mapping':
		$_POST['project_desc']="Is an indoor navigable office robot, primary aim is to automate the way things move in the office";
		break;
	case 'Autonomous All Terrain Vehicle':
		$_POST['project_desc']="Autonomous Off terrain navigation has been a challenge, developing robots that are able to manoeuver through rocky and off terrains is the target";
		break;
	case 'Lighter Than Air Unmanned Aerial Vehicle':
		$_POST['project_desc']="Converting the traditional UAV's into a lighter than air vehicle increases the flight time upto 10 times thus extending their power to stay airborne";
		break;
	case 'Stereovision : Obstacle Detection using 3-D Camera':
		$_POST['project_desc']="Environment Mapping and Navigation using stereovision for off terrain applications(like trekking a rocky hill)";
		break;
	case 'Driving an Autonomous Vehicle using Image Processing':
		$_POST['project_desc']="Obstacle and lane detection using Image processing and making a bot move in the specified lane and on a particular heading";
		break;
	default:
		# code...
		break;
	}
}
else{
$fields=array("team_name","project_name","by","project_desc","club","slot","t1_name","t1_email","t1_roll","t1_contact","t1_hostel","t2_name","t2_email","t2_roll","t2_contact","t2_hostel","t3_name","t3_email","t3_roll","t3_contact","t3_hostel","t4_name","t4_email","t4_roll","t4_contact","t4_hostel");
}

$q="insert into itsp_project ";
$field="(";
$value="(";
	$j=0;
foreach ($fields as $i) {
	# code...
	if($j!=0)
	{
		$field.=",";
		$value.=",";
	}
	$field.="`".$i."`";
	$value.="'".mysqli_real_escape_string($con,$_POST[$i])."'";
	$j=1;
}
$q.=$field.") values ".$value.")";
$a= mysqli_query($con,$q);
if($a==1)
die("done");
else
die("error");

?>