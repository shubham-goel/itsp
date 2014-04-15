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
	$q=mysqli_query($con,"select * from outsider_itsp where `email`='".$outsider."'");
	if(mysqli_num_rows($q)<=0)
		header("Location:php/logout.php");
	$userdata=mysqli_fetch_assoc($q);
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
				</header>';

				
			
				echo '<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-body">
						<h1>The registration is closed</h1>
						
						</div>
					</div>
				</div>';
			echo '
			
			</article>
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
								echo '<hr>';
							echo '<b>Comments from Mentors:</b>';							
							echo "<br>".$project['mc1']."";
							echo "<br>".$project['mc2']."";
							echo "<br>".$project['mc3']."";
							echo "<br>".$project['mc4']."";
							echo "<br>".$project['mc5']."";
								echo '<hr>';
						if($project['acceptedby']==""||$project['acceptedby']=="0"){
								if($project['club']!="umic")
								{
								echo '
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
						echo	'<hr>';
						
							echo'<div>Your project is under review</div>
						<form id="dereg" method="post">
							<button class="col-md-4 col-md-offset-8 btn btn-danger">Deregister</button>
						</form>';

						}
						else
							echo "<div ><b>Congrats! Your project i accepted for ITSP 2014</b></div>";
						echo '</div>
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
						<h1>Resgistration is closed</h1>
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
								echo '<hr>';
								if($project['acceptedby']==""||$project['acceptedby']=="0"){
								echo '
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
							echo '<hr>';
							echo '<b>Comments from Mentors:</b>';							
							echo "<br>".$project['mc1']."";
							echo "<br>".$project['mc2']."";
							echo "<br>".$project['mc3']."";
							echo "<br>".$project['mc4']."";
							echo "<br>".$project['mc5']."";
						echo	'
						<hr>';
						
							echo'<div>Your project is under review</div>
						<form id="dereg" method="post">
							<button class="col-md-4 col-md-offset-8 btn btn-danger">Deregister</button>
						</form>';
					}
						else
							echo "<div ><b>Congrats! Your project i accepted for ITSP 2014</b></div>";
						
					echo'	</div>
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
					success:function(data){
						if(data=="done")
							location.reload();
						else{
							console.log(data);
							alert("Error");
						}
						
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
									<label>Email Address <span class="text-danger">*</span></label>
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
							or<b><a href="account.php"> Create account for ITSP</a>
							
							
						</div>
					</div>
				</div>
				
			</article>
			<script type="text/javascript">
			$("#login-form").submit(function(e) {
				data=$(this).serialize();
				jQuery.ajax({
					url:"php/login.php",
					data:data,
					type:"POST",
					success:function(data){
					console.log(data);
						if(data.trim()=="access")
							location.reload();
						else if(data.trim()=="deny")
							{
								$(\'#log-alert\').css(\'display\',\'block\');
								$("#log-alert-text").html("Password invalid. <a href=\'http://techid.stab-iitb.org/forgot/password\' target=_blank>Forgot password? </a>");
							}
						else if(data.trim()=="noemail")
							{
								$(\'#log-alert\').css(\'display\',\'block\');
								$("#log-alert-text").html("Email not found please <a href=\'http://techid.stab-iitb.org\' target=_blank>Register</a>");
							}
							else 
							{
								$(\'#log-alert\').css(\'display\',\'block\');
								$("#log-alert-text").html("UNKNOWN ERROR! Please contact us for this error");
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
								$("#rego-alert-text").html("A mail has been sent to you click it to register.If you didnt recieved the mail send a request to prateekchandan@iitb.ac.in with proper subject");
							}
						else if(data.trim()=="deny")
							{
								$(\'#rego-alert\').css(\'display\',\'block\');
								$("#rego-alert-text").html("Email already registered if you didn\'t recieve mail send a query to prateekchandan@iitb.ac.in");
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
