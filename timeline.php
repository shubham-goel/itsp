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
					<li  class="active"><a href="timeline.php">Timeline</a></li>
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
			<li class="active">Timeline</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">ITSP TIMELINE</h1>
				</header>
				<iframe src='http://cdn.knightlab.com/libs/timeline/latest/embed/index.html?source=0AolHa9BydZxLdDI4QmZfRE9iS3AyNUEzeFNZU0hUM2c&font=Bevan-PotanoSans&maptype=toner&lang=en&height=650' width='100%' height='650' frameborder='0'></iframe>

			</article>
			<!-- /Article -->
			
		

		</div>
	</div>	<!-- /container -->
	
	
		<?php include "downbar.php"; ?>