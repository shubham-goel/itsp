<?php
include "php/dbconnect.php";
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
					<li><a class="btn" href="register.php">REGISTER</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->


	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Projects</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Fill your details</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Fill in your details</h3>
							<hr>
							<div class="alert alert-danger alert-dismissable" style="display:none" id="log-alert">
						        <button type="button" class="close"onclick="$('#log-alert').css('display','none')">×</button>
						        <div id="log-alert-text">Invalid Email</div>
						    </div>
							<form id="reg-form">
								<div class="top-margin">
									<label>Email Address <span class="text-danger">*</span></label>
									<input type="email" class="form-control" name="email" value="<?php echo $email;?>">
								</div>

								<div class="top-margin">
										<label>Name <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="name" required>
								</div>
								<div class="top-margin">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="password" id="pass" required>
								</div>
								<div class="top-margin">
										<label>Retype Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="re-pass" id="rpass" required>
								</div>
								<div class="top-margin">
										<label>Contact no <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="contact" required>
								</div>
								<div class="top-margin">
										<label>College <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="college" required>
								</div>
								<div class="top-margin">
										<label>Year of study <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="year" required>
								</div>
									<input type="hidden" class="form-control" name="link" value="">
								<hr>

								<div class="row">
									<div class="col-lg-4 col-lg-offset-8 text-right">
										<button class="btn btn-action" type="submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<script type="text/javascript">
			$("#reg-form").submit(function(e) {
				if($("#pass").val()!=$("#rpass").val())
				{
					$('#log-alert').css('display','block');
								$("#log-alert-text").html("Password mismatch");
					return false;
				}
				data=$(this).serialize();
				jQuery.ajax({
					url:"php/regout.php",
					data:data,
					type:"POST",
					success:function(data){
						console.log(data);
						if(data="email-error"){
							$('#log-alert').css('display','block');
							$("#log-alert-text").html("Email already exist");
						}
						else{
					window.location = "http://itsp.stab-iitb.org/register.php";
						}
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
