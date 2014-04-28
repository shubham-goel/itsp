<?php

include "php/dbconnect.php";
session_start();
if(isset($_SESSION['id']))
	$user=$_SESSION['id'];
else
	$user=false;

$mentor=false;
$manager=false;
if($user==175||$user==15||$user==56)
	$manager=true;
if($user=='mentor')
	$mentor=true;
if($user=='manager')
	$manager=true;

?>
<?php include "header.php"; ?>
<style type="text/css">
	.desc{
		max-height: 120px;
		overflow: auto;
		font-size: 13px;
		min-width: 200px;
	}
	.comment{
		max-height: 120px;
		overflow: auto;
		font-size: 13px;
		min-width: 200px;
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
			<article class="col-md-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">List of Submitted projects</h1>
				</header>
				 <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
		<li class="active"><a href="#all" data-toggle="tab">All</a></li>
        <li><a href="#Wncc" data-toggle="tab">WNCC</a></li>
        <li><a href="#elec" data-toggle="tab">Electronics and Robotics Club</a></li>
        <li><a href="#aero" data-toggle="tab">Aeromodelling Club</a></li>
        <li><a href="#kritika" data-toggle="tab">Krittika</a></li>
        <li><a href="#mnp" data-toggle="tab">Maths and Physics</a></li>
        <li><a href="#umic" data-toggle="tab">UMIC</a></li>
        <li><a href="#outsiders" data-toggle="tab">Non IITB Project</a></li>
    </ul>
    <div id="my-tab-content" class="tab-content">
    	<div class="tab-pane active" id="all">
           <table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>Team id</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
					if($manager||$mentor)
					echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';
				
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && t1_roll!='outsider' order by club");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['team_id']."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'0">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",0)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{	

									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
        <div class="tab-pane " id="Wncc">
            <table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>
								Team id
							</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
if($manager||$mentor)
echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';
				
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='WnCC' && t1_roll!='outsider' order by slot");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['team_id']."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'1">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",1)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form1">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>

										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form1").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form1").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form1">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form1").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form1").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{	
									
									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
        <div class="tab-pane" id="elec">
            <table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>
								Team id
							</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
							if($manager||$mentor)
							echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';
			
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='Electronics and Robotics Club' && t1_roll!='outsider' order by slot");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['team_id']."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'2">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",2)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form2">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form2").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form2").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form2">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form2").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form2").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{
										
									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
        <div class="tab-pane" id="aero">
             <table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>
								Team id
							</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
							if($manager||$mentor)
							echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';			
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='Aeromodelling Club' && t1_roll!='outsider' order by slot");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['team_id']."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'3">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",3)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form3">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form3").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form3").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form3">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form3").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form3").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{		
									echo "<td><div class='comment'>".$row['mentor1']."</div></td>";
									echo "<td><div class='comment'>".$row['mentor2']."</div></td>";
									echo "<td><div class='comment'>".$row['mentor3']."</div></td>";
					
									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
        <div class="tab-pane" id="kritika">
            <table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>
								Team id
							</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
							if($manager||$mentor)
							echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';			
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='Krittika' && t1_roll!='outsider' order by slot");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['team_id']."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'4">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",4)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form4">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form4").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form4").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form4">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form4").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form4").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{	
									
									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
        <div class="tab-pane" id="mnp">
            <table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>Team id</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
							if($manager||$mentor)
							echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';			
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && club='MnP club' && t1_roll!='outsider' order by slot");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								echo "<td>".$row['team_id']."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'5">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",5)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form5">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form5").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form5").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form5">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form5").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form5").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{	
									
									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
        <div class="tab-pane" id="umic">
	        <?php
							$q=mysqli_query($con,"select * from itsp_project where `club` ='umic'");
							if(mysqli_num_rows($q)>0)
							{
								echo '<h2>UMIC Projects</h2><table class="table table-bordered">
							<thead>
								<tr>
								<th>
									Project Name
								</th>
								<th>
									Name
								</th>
								';
					
								if($manager||$mentor)
								echo '
								<th>
									Email
								</th>
								<th>
									Contact
								</th>
								<th>
									Hostel/Room
								</th>
								<th>
									Action
								</th>
								';
								while($row=mysqli_fetch_assoc($q))
								{
									echo "<tr>";
									echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								
									echo "<td>".$row['t1_name']."</td>";									
									if($manager){
										echo "<td>".$row['t1_email']."</td>";
									echo "<td>".$row['t1_contact']."</td>";
									echo "<td>".$row['t1_hostel']."</td>";
										if($row['acceptedby']==""||$row['acceptedby']=="0")
										echo '									
										<td>
										
											<input name="name" placeholder ="name" id="'.$row['by'].'6">
											<button class="btn btn-success" onclick=accept("'.$row['by'].'",6)>Accept</button>
										
										</td>';
										else
											echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';
									}

								}
								
								echo '</tr>
							</thead>';


							echo "</table>";
							}
			?>
        </div>
        <div class="tab-pane" id="outsiders">
        	<table class="table table-bordered">
						<thead>
							<tr>
							<th>Sl no</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Project Description
							</th>
							<th>
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Members
							</th>
							<th>
								Abstract
							</th>
							<?php
							if($manager)
							echo '
							<th>
								Action
							</th>
							
							';
							if($manager||$mentor)
							echo '<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>';
				
							?>
							
							<th>
								Mentor Comment-1
							</th>
							<th>
								Mentor Comment-2
							</th>
							<th>
								Mentor Comment-3
							</th>
							<th>
								Mentor Comment-4
							</th>
							<th>
								Mentor Comment-5
							</th>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && t1_roll='outsider'");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo '<td><div class="desc">'.$row['project_desc'].'</div></td>';
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";							

								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";

								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								

								if($manager||$mentor){
									echo "Contact details :";
								if($row['t1_email']!="")
									echo "<br>".$row['t1_email']."";
								if($row['t1_contact']!="")
									echo "<br>".$row['t1_contact']."";
								}
								
								echo "</ul></td>";
								if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
								
								if($manager){
									
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'7">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'",7)>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								if($manager||$mentor){
									$Mentor=array('mentor1','mentor2','mentor3');
									foreach ($Mentor as $key) {
										if($row[$key]==""){
											echo '<td><form id="'.$row['by'].$key.'-form6">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name" required>
										<input type="email" class="form-control" name="email" placeholder="email" required>
										<input type="number" class="form-control" name="phone" placeholder="phone" required>
										<input type="text" class="form-control" name="roll" placeholder="Roll" required>
										Present in summer ?<br>
										<input type="radio" value="Present in summer" name="summer">Yes
										<input type="radio" value="Not present in summer" name="summer">No<br>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">Apply for Mentor</button></form>
										<script>
											$("#'.$row['by'].$key.'-form6").submit(function(){
												jQuery.ajax({
													url:"php/addmentor.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form6").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';

										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}
									$mc=array('mc1','mc2','mc3','mc4','mc5');
									foreach ($mc as $key ) {
										if($row[$key]==""){
										echo '<td><form id="'.$row['by'].$key.'-form7">
										<input type="hidden" name="by" value="'.$row['by'].'">
										<input type="hidden" name="field" value="'.$key.'">
										<input type="text" class="form-control" name="name" placeholder="name">
										<textarea name="comment" placeholder="add comment"></textarea>
										<button class="btn btn-success btn-xs" style="padding: 5px;margin: auto;margin-top: 3px;">ADD COMMENT</button></form>
										<script>
											$("#'.$row['by'].$key.'-form7").submit(function(){
												jQuery.ajax({
													url:"php/addcomment.php",
													type:"POST",
													data:$(this).serialize(),
													success:function(data){
														$("#'.$row['by'].$key.'-form7").html(data);
													},
													error:function(){
														alert("error");
													}
												});
												return false;
											})
										</script>
										</td>';
										}
										else{
											echo "<td><div class='comment'>".$row[$key]."</div></td>";
										}
									}								
								}	
								else{	
									
									echo "<td><div class='comment'>".$row['mc1']."</div></td>";
									echo "<td><div class='comment'>".$row['mc2']."</div></td>";
									echo "<td><div class='comment'>".$row['mc3']."</div></td>";
									echo "<td><div class='comment'>".$row['mc4']."</div></td>";
									echo "<td><div class='comment'>".$row['mc5']."</div></td>";
								}
								echo "</tr>";

							}
						?>
					</table>
        </div>
    </div>
				
			</article>
			<!-- /Article -->

		</div>
		<script type="text/javascript">
<?php
if($manager)
{
	echo 'function accept(by,i){
		$.post(\'php/accept.php\',{
				by:by,
				accepter:$("#"+by+i).val()
			}).done(function(data){
				location.reload();
			})
	}';
}
?>
		</script>
	</div>	<!-- /container -->
	<?php include "downbar.php"; ?>
