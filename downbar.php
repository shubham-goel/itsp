<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">							
								<a href="mailto:rahul.prajapat9@gmail.com">rahul.prajapat9@gmail.com</a>
								<br>
								Overall Coordinator , STAB
								<br><br>
								Official Email id :
								<a href="mailto:itsp2014.stab@gmail.com">itsp2014.stab@gmail.com</a><br>
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href="https://www.youtube.com/user/STABiitb"><i class="fa fa-youtube fa-2"></i></a>
								<a href="http://www.stab-iitb.org"><i class="fa fa-dribbble fa-2"></i></a>
								<a href="https://github.com/wncc"><i class="fa fa-github fa-2"></i></a>
								<a href="https://www.facebook.com/pages/TechIITB/140784162601203"><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">About STAB</h3>
						<div class="widget-body">
							<p>Broken that toy to see of how that spring worked. Failed miserably at putting that FM Radio back together after unscrewing it to take a peek. Remember the sense of elation reading 'Hello World' on the screen. As you might have guessed coming to IITB you are not alone. From circuit benders to star gazers we have it all here. Technical Activities (lovingly abbreviated by IITB lingo to Tech) here provide a vast scope for fulfilling those geek pangs.</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="index.php">Home</a> | 
								<a href="about.php">About</a> |
								<a href="timeline.php">Timeline</a> |
								<a href="archive.php">Archive</a> |
								<a href="FAQ.php">FAQs</a> |
								<a href="projects.php">Projects</a> |
								<?php
								session_start();
								if(isset($_SESSION['id'])||isset($_SESSION['outsider']))
								echo '<a href="php/logout.php">Logout</a>';
								else
								echo '<a href="signin.php">Login</a>';
								?>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2014, <a href="http://www.stab-iitn.org">STAB</a><a href="http://www.iitb.ac.in"> IITB</a>. Designed by <a href="http://www.cse.iitb.ac.in/~prateekchandan/" rel="designer">Prateek Chandan</a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</footer>	
		




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
	</body>
</html>