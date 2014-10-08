<?php include "header.php"; ?>
<style type="text/css">
	.plist{
		list-style: square;
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
					<li  class="active"><a href="archive.php">Archive</a></li>
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
			<li class="active">Archives</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-md-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Archives and Resources</h1>
				</header>
				<h2 class="page-title">Some Resources</h2>
				<div class="col-md-12">
					<ul>
						<li><a href="http://homepages.iitb.ac.in/~ashaytejwani/BasicsComponents_ET.pdf" target=_blank>Basic Components .. A beginner's guide to components</a></li>
						<li><a href="http://homepages.iitb.ac.in/~ashaytejwani/LogicGates%20and%20ICs_ET.pdf" target=_blank>An introduction to logic gates and IC's</a></li>
						<li>
							<a href="https://www.youtube.com/watch?v=JMMamSVy1Zs&authuser=0" target=_blank>Youtube : Introduction to AVR - A beginner's guide</a>
						</li>
						<li>
							<a href="http://itsp.stab-iitb.org/resource/opencv%20installation.pdf" target=_blank>OpenCV Installation and Compilation in Ubuntu.</a><br>
							<a href="http://itsp.stab-iitb.org/resource/new" target=_blank>new</a><br>
							<a href="http://itsp.stab-iitb.org/resource/opencv2_4_6_1.sh" target=_blank>opencv2_4_6_1.sh</a>
						</li>
					</ul>

				</div>
				<h2 class="page-title">Sessions during ITSP</h2>
				<div class="col-md-12">
					<ul>
						<li>	
							<div>Introduction to Image Processing in OpenCV <br>
								<a href="http://itsp.stab-iitb.org/assets/Introduction%20to%20Image%20Processing%20in%20OpenCV.pdf" target=_blank>Slides</a>
								<br> Codes : <ul>
								<li>
									<a href="http://itsp.stab-iitb.org/resource/Iris.cpp">Iris.cpp</a>
								</li>
								<li>
									<a href="http://itsp.stab-iitb.org/resource/Track.cpp">Track.cpp</a>
								</li>
								</ul>
							</div>
						</li>
						<li>
							<div>Session on Eagle. <br>Slides:</div>
							<ul>
								<li>
									<a href="http://itsp.stab-iitb.org/resource/eagle_tutorial.pdf" target=_blank>Eagle tutorial</a>
								</li>
								<li>
									<a href="http://itsp.stab-iitb.org/resource/EAGLE%20PCB%20Design.pdf" target=_blank>Eagle PCB Design</a>
								</li>
								<li>
									<a href="http://itsp.stab-iitb.org/resource/PCBDesignTutorialRevA.pdf" target=_blank>PCB Design tutorial</a>
								</li>
								<li>
									<a href="http://itsp.stab-iitb.org/resource/Eagle%20Rules.pdf" target=_blank>Eagle Rules</a>
								</li>
								<li>
									<a href="https://www.youtube.com/watch?v=1AXwjZoyNno&list=PLir_96O_k3kmHN3q-WX2HuqpN327c4vkD" target=_blank>Youtube : Eagle - Shematic design</a>
								</li>
								
							</ul>
						</li>
						<li>
							<div>Communication Protocol Session. <br>Relevant Links:</div>
							<ul>
								<li>
									<a href="http://stab-iitb.org/wiki/Serial_Communication" target=_blank>SerialCommunicationl</a>
								</li>
								<li>
									<a href="http://arduino.cc/en/reference/wire" target=_blank>Implementing I2C using arduino</a>
								</li>
								<li>
									<a href="http://www.byteparadigm.com/applications/introduction-to-i2c-and-spi-protocols/" target=_blank>Introduction to I2C and SPI Protocols</a>
								</li>
								<li>
									<a href="http://en.m.wikibooks.org/wiki/Serial_Programming/Serial_Linux" target=_blank>Serial Programming/Serial Linux</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
					<h2 class="page-title">Possible Project Ideas</h2>
				
				<div class="col-md-6">
					<h4>Web and Coding Club</h4>
						<ol class="plist">
							<li>Centralized portal for creating LDAP based polls which can be restricted by roll number (for department elections, class polls, etc)</li>
							<li>Gesture controlled computer</li>
							<li>Physics simulation engine</li>
							<li>Text based adventure game</li>
							<li>Improvements to your favorite browser!</li>
							<li>Centralized FB app for events</li>
							<li>Real-time augmentation of dance</li>
						</ol>
				</div>
				<div class="col-md-6">
					<h4>Aeromodelling Club</h4>
					<ol class="plist">
						<li>Lighter than Air vehicle based intra or inter department mailing system (like Ministry of Magic)</li>
						<li>3D foam cutter </li>
						<li>RC paraglider</li>
						<li>RC submarine</li>
						<li>Thrust Vector RC kite</li>
						<li>Twincopter</li>
						<li>Hydrofoil</li>
						<li>Hybrid Quadrotor</li>
						<li>Delta-winged Aircraft</li>
						<li>Automatic Flight Control System</li>
					</ol>
				</div>
				
				<div class="col-md-6">
					<h4>Maths and Physics Club</h4>
					<ol class="plist">
						<li>Kelvin Dropper Experimental Demonstration</li>
						<li>Cockroft Walton multiplier [High DC Voltage source: Useful in particle detectors]</li>
						<li>Demonstration and study of Sonoluminescence</li>
						<li>Construction of Tesla Coil and using it for demonstration and possible innovative ideas.</li>
						<li>Build a Railgun and use it for amusement demonstration, atmospheric study, aerospace experiments or simple taking photographs of insti from sky. (Innovate other uses)</li>
						<li>Plasma Speakers (or flame speakers) [Provide a better quality and chance to learn a lot]</li>
						<li>Magnetic Levitation Walkways (PS will be to demonstrate the feasibility by a prototype and plan the structure… Implementation will be done in the semester)</li>
						<li>Cosmic Microwave Background Detection and study (motivated by recent discovery of Gravitational waves)</li>
						<li>Nuclear Fusion (Attempt to get into the list of the few students who have achieved nuclear fusion, will take help from an open source community, PS will be prototype demonstration and planning, will be implemented during the semester)</li>
						<li>Mathematical modelling of a student’s life, or lectures or similar day to day things in the campus with use of non-linear dynamics and statistics.</li>

					</ol>
				</div>
				<div class="col-md-6">
					<h4>Krittika Club</h4>
					<ol class="plist">
						<li>GoTo Software and Hardware</li>
						<li>Orrery</li>
						<li>Solar Radio Telescope</li>
						<li>Barn door tracker</li>
						<li>Photometer project</li>
						<li>Telescope building</li>
						<li>Radio dish</li>
						<li>Data analysis</li>
						<li>Electronic circuits for signal processing of radio telescopes</li>
					</ol>
				</div>
				<div class="col-md-6">
					<h4>Robotics and Electronics Club</h4>
						<ol class="plist">
							<li>Voice Recognition System</li>
							<li>Contactless Tachometer (angular speed measurement)</li>
							<li>Mechanical mobile charger</li>
							<li>Motion tracking/ gesture recognition</li>
							<li>Guitar tuner</li>
							<li>Pole-Climber bot</li>
							<li>Micromuse</li>
							<li>Holographic Keyboard</li>
							<li>Robotic Sketcher</li>
							<li>Digital slate using GLCD and touch screen</li>
							<li>L293D tester / IC tester</li>
							<li>Wizard’s chess</li>
							<li><li>Basic sign language to speech using image processing</li>
							<li>Mobile jammer</li>
							<li>Light ray follower bot</li>
							<li>Universal remote</li>
							<li>Temp based ceiling fan control</li>
							<li>Internet controlled bot</li>
						</ol>
				</div>
				
				

			
			</article>
			<!-- Sidebar -->
			<aside class="col-md-4 sidebar sidebar-right">
				<div class="well">
					<h4><a href="./projects.php" target="_blank">Go here</a> to see the current projects of 2014</h4>
				</div>
				<div class="well">
					<h4><a href="http://www.stab-iitb.org/wiki/ITSP_2013" target="_blank">Go here</a> to see the Projects of year 2013</h4>
				</div>
				<div class="well">
					<h4><a href="http://www.stab-iitb.org/wiki/ITSP_2012" target="_blank">Go here</a> to see the Projects of year 2012</h3>
				</div>   

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->

	<?php include "downbar.php"; ?>
