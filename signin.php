<?php
session_start();
if(isset($_SESSION['id']))
	header("Location:http://itsp.stab-iitb.org/projects.php");
include "php/dbconnect.php";
if(isset($_POST['login-email']))
{
$email=$_POST['login-email'];
$a=$_POST['login-password'];
$query=mysqli_query($con,"select  * from  signup_user where email='".$email."'");
if(mysqli_num_rows($query)<=0)
die("noemail");
$data=mysqli_fetch_assoc($query);
$p=$data['password'];
$salt=explode('$',$p);
$salt=$salt[2];

$hash=trim(shell_exec('python user.py '.$a.' '.$salt));
if($hash == $p)
{
	$_SESSION['id']=$data['id'];
	header("Location:http://itsp.stab-iitb.org/projects.php");
}
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
			<li class="active">Signin</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Signin to ITSP</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Login with your techid</h3>
							<p class="text-center text-muted">If you haven't created a techid account , <a href="http://techid.stab-iitb.org/" target=_blank>Click here</a> to create</p>
							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="log-alert">
						        <button type="button" class="close"onclick="$('#log-alert').css('display','none')">×</button>
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
								$('#log-alert').css('display','block');
								$("#log-alert-text").html("Password invalid. <a href='http://techid.stab-iitb.org/forgot/password' target=_blank>Forgot password? </a>");
							}
						else if(data.trim()=="noemail")
							{
								$('#log-alert').css('display','block');
								$("#log-alert-text").html("Email not found please <a href='http://techid.stab-iitb.org' target=_blank>Register</a>");
							}
							else 
							{
								$('#log-alert').css('display','block');
								$("#log-alert-text").html("UNKNOWN ERROR! Please contact us for this error");
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
			


		</div>
	</div>	<!-- /container -->
<?php include "downbar.php"; ?>


