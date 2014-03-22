<?php
include "php/dbconnect.php";
session_start();
if(isset($_SESSION['id']))
	$user=$_SESSION['id'];
else
	$user=false;
$userdata=mysqli_fetch_assoc(mysqli_query($con,"select * from signup_user where id=".$user));
$name=$user['first_name'].' '.['last_name'];
?>
<?php include "header.php"; ?>
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
					<li class="active"><a class="btn" href="signin.php">REGISTER</a></li>
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
			if($user){
				echo '
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Project Registration</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register your project</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signin.php">Login</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>

							<form>
								<div class="top-margin">
									<label>Team Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control">
								</div>
								<div class="top-margin">
									<label>Select the club</label>
									<select class="form-control">
									<option>WnCC</option>
									<option>MnP club</option>
									<option>Electronics and Robotics Club</option>
									<option>Aeromodelling Club</option>
									<option>Krittika</option>
									</select>
								</div>
								<div class="top-margin">
									<label>Slot Preference</label>
									<input type="radio" name="slot" value="1">Slot1 (5th May-16th June)
									<input type="radio" name="slot" value="2">Slot2 (15th May-10th June)
								</div>
								<div class="top-margin">
									<label>Project Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control">
								</div>

								<div class="row top-margin">
									<div class="col-sm-12">
										Hello
									</div>
									<div class="col-sm-12">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="text" class="form-control">
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
			';
		}else
		{
				echo '
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Login to Register Project</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Login with your techid</h3>
							<p class="text-center text-muted">If you haven\'t created a techid account , <a href="http://techid.stab-iitb.org/" target=_blank>Click here</a> to create</p>
							<hr>

							<form id="login-form">
								<div class="top-margin">
									<label>Email Address(GPO) <span class="text-danger">*</span></label>
									<input type="email" class="form-control" name="login-email" required>
								</div>

								<div class="top-margin">
										<label>Password <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="login-password" required>
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
				
			</article>

			<!-- /Article -->
			';
		}
		?>
<script type="text/javascript">
	$("#login-form").submit(function(e) {
		data=$(this).serialize();
		jQuery.ajax({
			url:"php/login.php",
			data:data,
			type:"POST",
			success:function(data){
				if(data=="access")
					location.reload();
				else
					alert("error");
			},
			error:function(){
				alert("Error connecting");
			}
		})
		return false;
	});

</script>
		</div>
	</div>	<!-- /container -->
<?php include "downbar.php"; ?>