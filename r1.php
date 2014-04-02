<?php
include "php/dbconnect.php";
session_start();
if(isset($_SESSION['id']))
	$user=$_SESSION['id'];
else
	$user=false;

if($user)
{
	$project=mysqli_query($con,"select * from itsp_project where `by`='".$user."'");
	if(mysqli_num_rows($project)>0)
	{
	$userchk=-1;

	$project = mysqli_fetch_assoc($project);
	}
	$userdata=mysqli_fetch_assoc(mysqli_query($con,"select * from signup_user where id='".$user."'"));
	$name=$userdata['first_name'].' '.$userdata['last_name'];
	$roll=$userdata['rollno'];
}
if(isset($_SESSION['outsider'])){
	$outsider=$_SESSION['outsider'];
	$project=mysqli_query($con,"select * from itsp_project where `by`='".$outsider."'");
	if(mysqli_num_rows($project)>0)
	{
	$outsiderchk=-1;
	$project = mysqli_fetch_assoc($project);
	}
	$userdata=mysqli_fetch_assoc(mysqli_query($con,"select * from outsider_itsp where email='".$outsider."'"));
	$name=$userdata['name'];
}
?>
<?php include "header.php"; ?>
<style type="text/css">
	.btn-member{
		margin-bottom: 10px;
		margin-top: 10px;
		background-color: rgb(147, 214, 142);

	}
</style>
<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" alt="ITSP 2014"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.php">Home</a></li>
					<li><a href="timeline.php">Timeline</a></li>
					<li><a href="FAQ.php">FAQ</a></li>
					<li><a href="archive.php">Archive</a></li>
					<li><a href="about.php">About</a></li>
					<li class="active"><a class="btn" href="register.php">REGISTER</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<?php
			if($user && $userchk!=-1){
				echo '
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Project Registration</h1>
				</header>
				
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register your project</h3>
							<div class="text-center text-muted"><b>Instructions</b></div>				
							<div class="text-center text-muted">1. This is a one-time registration so fill in up all details very carefully</div>
							<div class="text-center text-muted">2. The project description should describe your project consicely in one-two lines</div>
							<div class="text-center text-muted">3. It is mandatory for atleast one team member which should be you</div>


							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="reg-alert">
						        <button type="button" class="close"onclick="$(\'#reg-alert\').css(\'display\',\'none\')">×</button>
						        <div id="reg-alert-text">Please signup to get an user account</div>
						    </div>
							<form id="reg-form">
								<input type="hidden" name="by" value='.$user.'>
								<div class="top-margin">
									<label>Team Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="team_name" name="team_name" required>
								</div>
								<div class="top-margin">
									<label>Project Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="project_name" name="project_name" required>
								</div>
								<div class="top-margin">
									<label>Project Short Description(max 500 chars)</label>
									<input type="text" class="form-control" id="project_desc" name="project_desc">
								</div>
								<div class="top-margin">
									<label>Select the club</label>
									<select class="form-control" id="club" name="club">
									<option>WnCC</option>
									<option>MnP club</option>
									<option>Electronics and Robotics Club</option>
									<option>Aeromodelling Club</option>
									<option>Krittika</option>
									</select>
								</div>
								<div class="top-margin">
									<label>Slot Preference</label>
									<input type="radio" checked="checked" autocomplete="off" name="slot" value="1">Slot1 (5th May-16th June)
									<input type="radio" name="slot" autocomplete="off" value="2">Slot2 (15th May-10th June)
								</div>
								<label>Team Members Description</label>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member1\').slideToggle()">Team Member 1 Details<span class="text-danger">*</span></button>
								<div class="row" id="member1" style="display:none">
									<div class="col-md-12">
										<label>Name<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_name" name="t1_name" value="'.$name.'">
									</div>
									<div class="col-md-12">
										<label>Roll<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_roll" value="'.$roll.'" name="t1_roll">
									</div>
									<div class="col-md-12">
										<label>Email<span class="text-danger">*</span></label>
										<input class="form-control" type="email" id="t1_email" value="'.$userdata['email'].'" name="t1_email">
									</div>
									<div class="col-md-12">
										<label>Contact<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_contact" value="'.$userdata['mobile'].'" name="t1_contact">
									</div>
									<div class="col-md-12">
										<label>Hostel/Roomno eg:h9/178<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_hostel" name="t1_hostel" value="h'.$userdata['hostel_id'].'/'.$userdata['room'].'">
									</div>
								</div>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member2\').slideToggle()">Team Member 2 Details</button>
								<div class="row" id="member2" style="display:none">
									<div class="col-md-12">
										<label>Name</label>
										<input class="form-control" type="text" id="t2_name" name="t2_name">
									</div>
									<div class="col-md-12">
										<label>Roll</label>
										<input class="form-control" type="text" id="t2_roll" name="t2_roll" >
									</div>
									<div class="col-md-12">
										<label>Email</label>
										<input class="form-control" type="email" id="t2_email" name="t2_email">
									</div>
									<div class="col-md-12">
										<label>Contact</label>
										<input class="form-control" type="text" id="t2_contact" name="t2_contact">
									</div>
									<div class="col-md-12">
										<label>Hostel/Roomno eg:h9/178</label>
										<input class="form-control" type="text" id="t2_hostel" name="t2_hostel">
									</div>
								</div>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member3\').slideToggle()">Team Member 3 Details</button>
								<div class="row" id="member3" style="display:none">
									<div class="col-md-12">
										<label>Name</label>
										<input class="form-control" type="text" id="t3_name" name="t3_name">
									</div>
									<div class="col-md-12">
										<label>Roll</label>
										<input class="form-control" type="text" id="t3_roll" name="t3_roll" >
									</div>
									<div class="col-md-12">
										<label>Email</label>
										<input class="form-control" type="email" id="t3_email" name="t3_email">
									</div>
									<div class="col-md-12">
										<label>Contact</label>
										<input class="form-control" type="text" id="t3_contact" name="t3_contact">
									</div>
									<div class="col-md-12">
										<label>Hostel/Roomno eg:h9/178</label>
										<input class="form-control" type="text" id="t3_hostel" name="t3_hostel">
									</div>
								</div>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member4\').slideToggle()">Team Member 4 Details</button>
								<div class="row" id="member4" style="display:none">
									<div class="col-md-12">
										<label>Name</label>
										<input class="form-control" type="text" id="t4_name" name="t4_name">
									</div>
									<div class="col-md-12">
										<label>Roll</label>
										<input class="form-control" type="text" id="t4_roll" name="t4_roll" >
									</div>
									<div class="col-md-12">
										<label>Email</label>
										<input class="form-control" type="email" id="t4_email" name="t4_email">
									</div>
									<div class="col-md-12">
										<label>Contact</label>
										<input class="form-control" type="text" id="t4_contact" name="t4_contact">
									</div>
									<div class="col-md-12">
										<label>Hostel/Roomno eg:h9/178</label>
										<input class="form-control" type="text" id="t4_hostel"  name="t4_hostel" >
									</div>
								</div>

				

								<hr>

								<div class="row">
									<div class="col-lg-4 col-lg-offset-8 text-right">
										<button class="btn btn-action" type="submit">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register for one of the UMIC Projects</h3>
							<div class="text-center text-muted"> <b>Instructions:</b></div>
							<div class="text-center text-muted">1. You could either register in ITSP or only <b>One</b> of the UMIC Projects</div>
							<div class="text-center text-muted">2. You will be working with well-established Project teams adequately</div>
							<div class="text-center text-muted">3. Project duration is <b>2 months</b></div>
							<div class="text-center text-muted">4. Rigorous Mentoring, team meets and task allotment on daily basis</div>
							<div class="text-center text-muted">5. Project will be highly Oriented towards product Development(High scalability,Patenting and Finished Prototypes)</div>
							<div class="text-center text-muted">6. The project wil have high deliverables, thus, <b>long hours of hard work and steep learning curves</b>, it will be like 2 month long Hackathon</div>
							<br>
							<div class="text-center text-muted"> For further details contact<br>Arpit gupta &nbsp;09920134740<br>Pranjal Jain &nbsp;09820718025<br>
							or visit <a href="http://www.umic-iitb.org/" target=_blank>UMIC WEBSITE</a></div>

							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="regu-alert">
						        <button type="button" class="close"onclick="$(\'#regu-alert\').css(\'display\',\'none\')">×</button>
						        <div id="reg-alert-text">Please signup to get an user account</div>
						    </div>
							<form id="regu-form">
								<input type="hidden" name="by" value='.$user.'>
								<input type="hidden" name="umic" value="true">
								<input type="hidden" name="club" value="umic">
								<input type="hidden" name="project_desc" value="UMIC Project">
								<div class="row" id="member1">
									<div class="col-md-12">
										<label>Name<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_name" name="t1_name" value="'.$name.'">
									</div>
									<div class="col-md-12">
										<label>Roll<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_roll" value="'.$roll.'" name="t1_roll">
									</div>
									<div class="col-md-12">
										<label>Email<span class="text-danger">*</span></label>
										<input class="form-control" type="email" id="t1_email" value="'.$userdata['email'].'" name="t1_email">
									</div>
									<div class="col-md-12">
										<label>Contact<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_contact" value="'.$userdata['mobile'].'" name="t1_contact">
									</div>
									<div class="col-md-12">
										<label>Hostel/Roomno eg:h9/178<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_hostel" name="t1_hostel" value="h'.$userdata['hostel_id'].'/'.$userdata['room'].'">
									</div>
								</div>
								<div class="row">
								<hr>
									<h4> Select one of the UMIC projects to register</h4>
									<div class="col-md-12">
										<input type="radio" name="project_name" value="Snake Robot">
										<label>Snake Robot</label>
										<p>Snakes have the ability to handle rugged terrains and manoeuvre through natural obstacles easily</p>
									</div>
									<div class="col-md-12">
										<input type="radio" name="project_name" value="Indoor Navigation and Mapping">
										<label>Indoor Navigation and Mapping</label>
										<p>Is an indoor navigable office robot, primary aim is to automate the way things move in the office</p>
									</div>
									<div class="col-md-12">
										<input type="radio" name="project_name" value="Autonomous All Terrain Vehicle">
										<label>Autonomous All Terrain Vehicle</label>
										<p>Autonomous Off terrain navigation has been a challenge, developing robots that are able to manoeuver through rocky and off terrains is the target</p>
									</div>
									<div class="col-md-12">
										<input type="radio" name="project_name" value="Lighter Than Air Unmanned Aerial Vehicle">
										<label>Lighter Than Air Unmanned Aerial Vehicle</label>
										<p>Converting the traditional UAV\'s into a lighter than air vehicle increases the flight time upto 10 times thus extending their power to stay airborne</p>
									</div>
									<div class="col-md-12">
										<input type="radio" name="project_name" value="Stereovision : Obstacle Detection using 3-D Camera">
										<label>Stereovision : Obstacle Detection using 3-D Camera</label>
										<p>Environment Mapping and Navigation using stereovision for off terrain applications(like trekking a rocky hill)</p>
									</div>
									<div class="col-md-12">
										<input type="radio" name="project_name" value="Driving an Autonomous Vehicle using Image Processing">
										<label>Driving an Autonomous Vehicle using Image Processing</label>
										<p>Obstacle and lane detection using Image processing and making a bot move in the specified lane and on a particular heading</p>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-lg-offset-8 text-right">
										<button class="btn btn-action" type="submit">Register</button>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
				
			</article>
			<!-- /Article -->
			<script type="text/javascript">
	$("#reg-form").submit(function(e) {
		var a=0;
		if($("#t1_name").val()==""||$("#t1_roll").val()==""||$("#t1_email").val()==""||$("#t1_contact").val()==""||$("#t1_hostel").val()=="")
		{
			$("#reg-alert-text").html("Fill Team member1 details completely");
			$("#reg-alert").css("display","block");
			return false;
		}
		data=$(this).serialize();
		jQuery.ajax({
			url:"php/regproject.php",
			data:data,
			type:"POST",
			success:function(data){
			console.log(data);
				if(data.trim()=="done")
				{
					$(".panel-body").html("<h1><i class=\'fa fa-check\'></i> Form successfully submitted</h1>");
				}
				else
				{
					$("#reg-alert-text").html("Some error occured while submittin the project");
					$("#reg-alert").css("display","block");
				}
			},
			error:function(){
				alert("Error connecting");
			}
		})
		return false;
	});
$("#regu-form").submit(function(e) {
		var a=0;
		if($("#t1_name").val()==""||$("#t1_roll").val()==""||$("#t1_email").val()==""||$("#t1_contact").val()==""||$("#t1_hostel").val()=="")
		{
			$("#regu-alert-text").html("Fill Team member1 details completely");
			$("#regu-alert").css("display","block");
			return false;
		}
		data=$(this).serialize();
		jQuery.ajax({
			url:"php/regproject.php",
			data:data,
			type:"POST",
			success:function(data){
			console.log(data);
				if(data.trim()=="done")
				{
					$(".panel-body").html("<h1><i class=\'fa fa-check\'></i> Form successfully submitted</h1>");
				}
				else
				{
					$("#regu-alert-text").html("Some error occured while submittin the project");
					$("#regu-alert").css("display","block");
				}
			},
			error:function(){
				alert("Error connecting");
			}
		})
		return false;
	});

</script>
			';
		}else if($userchk==-1)
		{
			echo '
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">You have already registered</h1>
				</header>
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">'.$project['project_name'].'</h3>
							<p class="text-center text-muted">'.$project['project_desc'].'</p>
							<hr>

							<div>';
							if($project['club']!="umic")
								echo '<div class="top-margin">
									<label>Team Name :</label>
									'.$project['team_name'].'
								</div>';
							echo	'<div class="top-margin">
										<label>Club: </label>
										'.$project['club'].'
								</div>
								<div class="top-margin">
										<label>Members</label>
										<ul>';
										if($project['t1_name']!="")
										echo '<li>'.$project['t1_name'].'</li>';
										if($project['t2_name']!="")
										echo '<li>'.$project['t2_name'].'</li>';
										if($project['t3_name']!="")
										echo '<li>'.$project['t3_name'].'</li>';
										if($project['t4_name']!="")
										echo '<li>'.$project['t4_name'].'</li>';
										echo '</ul>
								</div>';
								if($project['club']!="umic")
								{
								echo '<hr>
								<form id="abstract-form" method="post" senctype="multipart/form-data">
								The skeleton of your abstract should be as follows: <br>
		                            1. Project title <br>
		                            2. Implementation steps (with a rough timeline) <br>
		                            3. Components required and their price estimate <br>
		                            4. What do you expect to learn by the end of the project? <br>
									<div class="top-margin">
									<div class="alert alert-danger alert-dismissable" style="display:none" id="log-alert">
								        <button type="button" class="close"onclick="$(\'#log-alert\').css(\'display\',\'none\')">×</button>
								        <div id="log-alert-text">Invalid File</div>
								    </div>';
								   if(file_exists("./abstract/".$user.".pdf"))
								   	echo '<label>You have already submitted abstract. <a target=_blank href="abstract/'.$user.'.pdf">Click</a> to view
								   <br>
								   Edit project abstract (Only pdf: Max 1MB)</label>';
								   	else
									echo '<label>Submit project abstract (Only pdf: Max 1MB)</label>';
								echo '<input type="file" name="abstract" class="form-control">
									<button class="btn btn-success" style="margin-top:10px;padding-bottom:5px;padding-top:5px;">Submit</button>
								</div>
								</form>';
							}
						echo	'
						<hr>
						<form id="dereg" method="post">
							<button class="col-md-4 col-md-offset-8 btn btn-danger">Deregister</button>
						</form>
						</div>
						</div>
					</div>

				</div>
			</article>
			<script type="text/javascript">
			$("#dereg").submit(function(e) {
				var a=confirm("Are you sure want to deregister");
				if(!a)
					return false;
				e.preventDefault();
				jQuery.ajax({
					url:"php/dereg.php",
					type:"POST",
					success:function(){
						location.reload();
					},
					error:function(){
						location.reload();
					}
				});
				return false;
			})
			$("#abstract-form").submit(function(e) {
				e.preventDefault();
				data=new FormData($("form")[0]);
				jQuery.ajax({
					url:"php/abstract-submit.php",
					data:data,
					type:"POST",
					cache: false,
           			 contentType: false,
            		processData: false,
					success:function(data){
					console.log(data);
						if(data.trim()=="done")
							location.reload();
							else 
							{
								$(\'#log-alert\').css(\'display\',\'block\');
								$("#log-alert-text").html(data);
							}
					},
					error:function(){
						alert("Error connecting");
					}
				})
				return false;
			});
		</script>
			';

		}else if($outsider&& $outsiderchk!=-1)
		{
			echo '<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Project Registration</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register your project</h3>
							<div class="text-center text-muted"><b>Instructions</b></div>				
							<div class="text-center text-muted">1. This is a one-time registration so fill in up all details very carefully</div>
							<div class="text-center text-muted">2. The project description should describe your project consicely in one-two lines</div>
							<div class="text-center text-muted">3. It is mandatory for atleast one team member which should be you</div>


							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="reg-alert">
						        <button type="button" class="close"onclick="$(\'#reg-alert\').css(\'display\',\'none\')">×</button>
						        <div id="reg-alert-text">Please signup to get an user account</div>
						    </div>
							<form id="reg-form">
								<input type="hidden" name="by" value='.$outsider.'>
								<div class="top-margin">
									<label>Team Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="team_name" name="team_name" required>
								</div>
								<div class="top-margin">
									<label>Project Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="project_name" name="project_name" required>
								</div>
								<div class="top-margin">
									<label>Project Short Description(max 500 chars)</label>
									<input type="text" class="form-control" id="project_desc" name="project_desc">
								</div>
								<div class="top-margin">
									<label>Select the club</label>
									<select class="form-control" id="club" name="club">
									<option>WnCC</option>
									<option>MnP club</option>
									<option>Electronics and Robotics Club</option>
									<option>Aeromodelling Club</option>
									<option>Krittika</option>
									</select>
								</div>
								
									<input type="hidden"  name="slot" value="1">
								
								
								<label>Team Members Description</label>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member1\').slideToggle()">Team Member 1 Details<span class="text-danger">*</span></button>
								<div class="row" id="member1" style="display:none">
									<div class="col-md-12">
										<label>Name<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_name" name="t1_name" value="'.$name.'">
									</div>
	
										<input class="form-control" type="hidden" id="t1_roll" value="0" name="t1_roll">
									
									<div class="col-md-12">
										<label>Email<span class="text-danger">*</span></label>
										<input class="form-control" type="email" id="t1_email" name="t1_email" required>
									</div>
									<div class="col-md-12">
										<label>Contact<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_contact" value="" name="t1_contact" required>
									</div>
									<div class="col-md-12">
										<label>College/Year<span class="text-danger">*</span></label>
										<input class="form-control" type="text" id="t1_hostel" name="t1_hostel" required>
									</div>
								</div>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member2\').slideToggle()">Team Member 2 Details</button>
								<div class="row" id="member2" style="display:none">
									<div class="col-md-12">
										<label>Name</label>
										<input class="form-control" type="text" id="t2_name" name="t2_name">
									</div>
									<input class="form-control" type="hidden" id="t2_roll" value="0" name="t1_roll">
									<div class="col-md-12">
										<label>Email</label>
										<input class="form-control" type="email" id="t2_email" name="t2_email">
									</div>
									<div class="col-md-12">
										<label>Contact</label>
										<input class="form-control" type="text" id="t2_contact" name="t2_contact">
									</div>
									<div class="col-md-12">
										<label>College/Year</label>
										<input class="form-control" type="text" id="t2_hostel" name="t2_hostel">
									</div>
								</div>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member3\').slideToggle()">Team Member 3 Details</button>
								<div class="row" id="member3" style="display:none">
									<div class="col-md-12">
										<label>Name</label>
										<input class="form-control" type="text" id="t3_name" name="t3_name">
									</div>
									<input class="form-control" type="hidden" id="t3_roll" value="0" name="t1_roll">
									<div class="col-md-12">
										<label>Email</label>
										<input class="form-control" type="email" id="t3_email" name="t3_email">
									</div>
									<div class="col-md-12">
										<label>Contact</label>
										<input class="form-control" type="text" id="t3_contact" name="t3_contact">
									</div>
									<div class="col-md-12">
										<label>College/Year</label>
										<input class="form-control" type="text" id="t3_hostel" name="t3_hostel">
									</div>
								</div>
								<button type="button" class="btn btn-member col-md-12" onclick="$(\'#member4\').slideToggle()">Team Member 4 Details</button>
								<div class="row" id="member4" style="display:none">
									<div class="col-md-12">
										<label>Name</label>
										<input class="form-control" type="text" id="t4_name" name="t4_name">
									</div>
									<input class="form-control" type="hidden" id="t4_roll" value="0" name="t1_roll">
									<div class="col-md-12">
										<label>Email</label>
										<input class="form-control" type="email" id="t4_email" name="t4_email">
									</div>
									<div class="col-md-12">
										<label>Contact</label>
										<input class="form-control" type="text" id="t4_contact" name="t4_contact">
									</div>
									<div class="col-md-12">
										<label>College/Year</label>
										<input class="form-control" type="text" id="t4_hostel"  name="t4_hostel" >
									</div>
								</div>

				

								<hr>

								<div class="row">
									<div class="col-lg-4 col-lg-offset-8 text-right">
										<button class="btn btn-action" type="submit">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
				
			</article>
			<!-- /Article -->
			<script type="text/javascript">
	$("#reg-form").submit(function(e) {
		var a=0;
		if($("#t1_name").val()==""||$("#t1_roll").val()==""||$("#t1_email").val()==""||$("#t1_contact").val()==""||$("#t1_hostel").val()=="")
		{
			$("#reg-alert-text").html("Fill Team member1 details completely");
			$("#reg-alert").css("display","block");
			return false;
		}
		data=$(this).serialize();
		jQuery.ajax({
			url:"php/regproject.php",
			data:data,
			type:"POST",
			success:function(data){
			console.log(data);
				if(data.trim()=="done")
				{
					$(".panel-body").html("<h1><i class=\'fa fa-check\'></i> Form successfully submitted</h1>");
				}
				else
				{
					$("#reg-alert-text").html("Some error occured while submittin the project");
					$("#reg-alert").css("display","block");
				}
			},
			error:function(){
				alert("Error connecting");
			}
		})
		return false;
	});

</script>
			';

		}
		else if($outsiderchk)
		{
			echo '
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">You have already registered</h1>
				</header>
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">'.$project['project_name'].'</h3>
							<p class="text-center text-muted">'.$project['project_desc'].'</p>
							<hr>

							<div>';
							if($project['club']!="umic")
								echo '<div class="top-margin">
									<label>Team Name :</label>
									'.$project['team_name'].'
								</div>';
							echo	'<div class="top-margin">
										<label>Club: </label>
										'.$project['club'].'
								</div>
								<div class="top-margin">
										<label>Members</label>
										<ul>';
										if($project['t1_name']!="")
										echo '<li>'.$project['t1_name'].'</li>';
										if($project['t2_name']!="")
										echo '<li>'.$project['t2_name'].'</li>';
										if($project['t3_name']!="")
										echo '<li>'.$project['t3_name'].'</li>';
										if($project['t4_name']!="")
										echo '<li>'.$project['t4_name'].'</li>';
										echo '</ul>
								</div>';
								
								echo '<hr>
								<form id="abstract-form" method="post" senctype="multipart/form-data">
								The skeleton of your abstract should be as follows: <br>
		                            1. Project title <br>
		                            2. Implementation steps (with a rough timeline) <br>
		                            3. Components required and their price estimate <br>
		                            4. What do you expect to learn by the end of the project? <br>
									<div class="top-margin">
									<div class="alert alert-danger alert-dismissable" style="display:none" id="log-alert">
								        <button type="button" class="close"onclick="$(\'#log-alert\').css(\'display\',\'none\')">×</button>
								        <div id="log-alert-text">Invalid File</div>
								    </div>';
								   if(file_exists("./abstract/".$outsider.".pdf"))
								   	echo '<label>You have already submitted abstract. <a target=_blank href="abstract/'.$outsider.'.pdf">Click</a> to view
								   <br>
								   Edit project abstract (Only pdf: Max 1MB)</label>';
								   	else
									echo '<label>Submit project abstract (Only pdf: Max 1MB)</label>';
								echo '<input type="file" name="abstract" class="form-control">
									<button class="btn btn-success" style="margin-top:10px;padding-bottom:5px;padding-top:5px;">Submit</button>
								</div>
								</form>';
							
						echo	'
						<hr>
						<form id="dereg" method="post">
							<button class="col-md-4 col-md-offset-8 btn btn-danger">Deregister</button>
						</form>
						</div>
						</div>
					</div>

				</div>
			</article>
			<script type="text/javascript">
			$("#dereg").submit(function(e) {
				var a=confirm("Are you sure want to deregister");
				if(!a)
					return false;
				e.preventDefault();
				jQuery.ajax({
					url:"php/dereg.php",
					type:"POST",
					success:function(){
						location.reload();
					},
					error:function(){
						location.reload();
					}
				});
				return false;
			})
			$("#abstract-form").submit(function(e) {
				e.preventDefault();
				data=new FormData($("form")[0]);
				jQuery.ajax({
					url:"php/abstract-submit.php",
					data:data,
					type:"POST",
					cache: false,
           			 contentType: false,
            		processData: false,
					success:function(data){
					console.log(data);
						if(data.trim()=="done")
							location.reload();
							else 
							{
								$(\'#log-alert\').css(\'display\',\'block\');
								$("#log-alert-text").html(data);
							}
					},
					error:function(){
						alert("Error connecting");
					}
				})
				return false;
			});
		</script>
			';

		}
		else
		{
				echo '
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Login to Register Project</h1>
				</header>
				
				<div class="col-md-6 ">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Login with your techid</h3>
							<p class="text-center text-muted">If you haven\'t created a techid account , <a href="http://techid.stab-iitb.org/" target=_blank>Click here</a> to create</p>
							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="log-alert">
						        <button type="button" class="close"onclick="$(\'#log-alert\').css(\'display\',\'none\')">×</button>
						        <div id="log-alert-text">Invalid Email</div>
						    </div>
							<form id="login-form">
								<div class="top-margin">
									<label>Email Address(Techid) <span class="text-danger">*</span></label>
									<input type="email" class="form-control" name="login-email" required>
								</div>

								<div class="top-margin">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="login-password" required>
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-4 col-lg-offset-8 text-right">
										<button class="btn btn-action" type="submit">Login</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-6 ">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Login(Only Outsiders) </h3>
							<p class="text-center text-muted"><b>Instrucions</b></p>
							<p class="text-center text-muted">Project submission is open from 1st April - 5th April</p>
							<p class="text-center text-muted">Only online mentorship is provided</p>
							<p class="text-center text-muted">If project is completed, you may get a chance to visit IIT Bombay for Display</p>
							<p class="text-center text-muted">Project submission is open from 1st April - 5th April</p>


							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="logo-alert">
						        <button type="button" class="close"onclick="$(\'#logo-alert\').css(\'display\',\'none\')">×</button>
						        <div id="logo-alert-text">Invalid Email</div>
						    </div>
							<form id="logino-form">
								<div class="top-margin">
									<label>Email Address(Techid) <span class="text-danger">*</span></label>
									<input type="email" class="form-control" name="login-email" required>
								</div>

								<div class="top-margin">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="login-password" required>
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-4 col-lg-offset-8 text-right">
										<button class="btn btn-action" type="submit">Login</button>
									</div>
								</div>
							</form>
							<hr>
							or<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="rego-alert">
						        <button type="button" class="close"onclick="$(\'#rego-alert\').css(\'display\',\'none\')">×</button>
						        <div id="rego-alert-text">Invalid Email</div>
						    </div>
							<form id="rego-form">
								<div class="top-margin">
									<label>Email Address <span class="text-danger">*</span></label>
									<input type="email" class="form-control" name="login-email" required>
								</div>

								<div class="row">
									<div class="col-lg-6 col-lg-offset-6 text-right">
										<button class="btn btn-action" type="submit">Click to register</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				
			</article>
			<script type="text/javascript">
			$("#login-form").submit(function(e) {
				data=$(this).serialize();
				jQuery.ajax({
					url:"php/logino.php",
					data:data,
					type:"POST",
					success:function(data){
					console.log(data);
						if(data.trim()=="access")
							location.reload();
						else if(data.trim()=="deny")
							{
								$(\'#logo-alert\').css(\'display\',\'block\');
								$("#logo-alert-text").html("Password invalid. <a href=\'http://techid.stab-iitb.org/forgot/password\' target=_blank>Forgot password? </a>");
							}
						else if(data.trim()=="noemail")
							{
								$(\'#logo-alert\').css(\'display\',\'block\');
								$("#logo-alert-text").html("Email not found please <a href=\'http://techid.stab-iitb.org\' target=_blank>Register</a>");
							}
							else 
							{
								$(\'#logo-alert\').css(\'display\',\'block\');
								$("#logo-alert-text").html("UNKNOWN ERROR! Please contact us for this error");
							}
					},
					error:function(){
						alert("Error connecting");
					}
				})
				return false;
			});
			$("#logino-form").submit(function(e) {
				data=$(this).serialize();
				jQuery.ajax({
					url:"php/logino.php",
					data:data,
					type:"POST",
					success:function(data){
					console.log(data);
						if(data.trim()=="access")
							location.reload();
						else if(data.trim()=="deny")
							{
								$(\'#logo-alert\').css(\'display\',\'block\');
								$("#logo-alert-text").html("Password invalid. ");
							}
						else if(data.trim()=="noemail")
							{
								$(\'#logo-alert\').css(\'display\',\'block\');
								$("#logo-alert-text").html("Email not found please Register");
							}
							else 
							{
								$(\'#logo-alert\').css(\'display\',\'block\');
								$("#logo-alert-text").html("UNKNOWN ERROR! Please contact us for this error");
							}
					},
					error:function(){
						alert("Error connecting");
					}
				})
				return false;
			});
			$("#rego-form").submit(function(e) {
				data=$(this).serialize();
				jQuery.ajax({
					url:"php/rego.php",
					data:data,
					type:"POST",
					success:function(data){
					console.log(data);
						if(data.trim()=="access")
							{
								$(\'#rego-alert\').css(\'display\',\'block\');
								$("#rego-alert-text").html("A mail has been sent to you click it to register");
							}
						else if(data.trim()=="deny")
							{
								$(\'#rego-alert\').css(\'display\',\'block\');
								$("#rego-alert-text").html("Email already registered");
							}
							else 
							{
								$(\'#rego-alert\').css(\'display\',\'block\');
								$("#rego-alert-text").html("UNKNOWN ERROR! Please contact us for this error");
							}
					},
					error:function(){
						alert("Error connecting");
					}
				})
				return false;
			});
		</script>
			<!-- /Article -->
			';
		}
		?>


		</div>
	</div>	<!-- /container -->
<?php include "downbar.php"; ?>
