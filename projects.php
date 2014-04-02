<?php

include "php/dbconnect.php";
session_start();
if(isset($_SESSION['id']))
	$user=$_SESSION['id'];
else
	$user=false;

$manager=false;
if($user==175||$user==15||$user==56)
	$manager=true;


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
			<article class="col-md-7 maincontent">
				<header class="page-header">
					<h1 class="page-title">List of Submitted projects</h1>
				</header>
				<div class="col-md-12">
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
								Slot
							</th>
							<th>
								Club
							</th>
							<th>
								Team Member 1 Details
							</th>
							<th>
								Team Member 2 Details
							</th>
							<th>
								Team Member 3 Details
							</th>
							<th>
								Team Member 4 Details
							</th>
							<?php
							if($manager)
							echo '<th>
								Abstract
							</th>
							<th>
								Action
							</th>
							
							';

							?>
							</tr>
						</thead>
						<?php
							$i=1;
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && t1_roll!='outsider' order by club");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$i."</td>";
								$i+=1;
								echo "<td>".$row['team_name']."</td>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
								echo "<td>".$row['slot']."</td>";
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";
								if($row['t1_roll']!="")
									echo "<li>".$row['t1_roll']."</li>";
								if($row['t1_email']!="")
									echo "<li>".$row['t1_email']."</li>";
								if($row['t1_contact']!="")
									echo "<li>".$row['t1_contact']."</li>";
								if($row['t1_hostel']!="")
								echo "<li>".$row['t1_hostel']."</li>";
								echo "</ul></td>";

								echo "<td><ul>";
								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t2_roll']!="")
									echo "<li>".$row['t2_roll']."</li>";
								if($row['t2_email']!="")
									echo "<li>".$row['t2_email']."</li>";
								if($row['t2_contact']!="")
									echo "<li>".$row['t2_contact']."</li>";
								if($row['t2_hostel']!="")
								echo "<li>".$row['t2_hostel']."</li>";
								echo "</ul></td>";

								echo "<td><ul>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";
								if($row['t3_roll']!="")
									echo "<li>".$row['t3_roll']."</li>";
								if($row['t3_email']!="")
									echo "<li>".$row['t3_email']."</li>";
								if($row['t3_contact']!="")
									echo "<li>".$row['t3_contact']."</li>";
								if($row['t3_hostel']!="")
								echo "<li>".$row['t3_hostel']."</li>";
								echo "</ul></td>";

								echo "<td><ul>";
								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								if($row['t4_roll']!="")
									echo "<li>".$row['t4_roll']."</li>";
								if($row['t4_email']!="")
									echo "<li>".$row['t4_email']."</li>";
								if($row['t4_contact']!="")
									echo "<li>".$row['t4_contact']."</li>";
								if($row['t4_hostel']!="")
								echo "<li>".$row['t4_hostel']."</li>";
								echo "</ul></td>";
								if($manager){
									if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'")>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								echo "</tr>";

							}
						?>
					</table>
					<h3>Project from outsiders</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
							<th>
								Sl no
							</th>
							<th>
								Team Name
							</th>
							<th>
								Project Name
							</th>
							<th>
								Club
							</th>
							<th>
								Team Member 1 Details
							</th>
							<th>
								Team Member 2 Details
							</th>
							<th>
								Team Member 3 Details
							</th>
							<th>
								Team Member 4 Details
							</th>
							<?php
							if($manager)
							echo '<th>
								Abstract
							</th>
							<th>
								Action
							</th>
							
							';

							?>
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
								echo "<td>".$row['club']."</td>";
								
								echo "<td><ul>";
								if($row['t1_name']!="")
									echo "<li>".$row['t1_name']."</li>";
								if($row['t1_email']!="")
									echo "<li>".$row['t1_email']."</li>";
								if($row['t1_contact']!="")
									echo "<li>".$row['t1_contact']."</li>";
								if($row['t1_hostel']!="")
								echo "<li>".$row['t1_hostel']."</li>";
								echo "</ul></td>";

								echo "<td><ul>";
								if($row['t2_name']!="")
									echo "<li>".$row['t2_name']."</li>";
								if($row['t2_email']!="")
									echo "<li>".$row['t2_email']."</li>";
								if($row['t2_contact']!="")
									echo "<li>".$row['t2_contact']."</li>";
								if($row['t2_hostel']!="")
								echo "<li>".$row['t2_hostel']."</li>";
								echo "</ul></td>";

								echo "<td><ul>";
								if($row['t3_name']!="")
									echo "<li>".$row['t3_name']."</li>";
								if($row['t3_email']!="")
									echo "<li>".$row['t3_email']."</li>";
								if($row['t3_contact']!="")
									echo "<li>".$row['t3_contact']."</li>";
								if($row['t3_hostel']!="")
								echo "<li>".$row['t3_hostel']."</li>";
								echo "</ul></td>";

								echo "<td><ul>";
								if($row['t4_name']!="")
									echo "<li>".$row['t4_name']."</li>";
								if($row['t4_email']!="")
									echo "<li>".$row['t4_email']."</li>";
								if($row['t4_contact']!="")
									echo "<li>".$row['t4_contact']."</li>";
								if($row['t4_hostel']!="")
								echo "<li>".$row['t4_hostel']."</li>";
								echo "</ul></td>";
								if($manager){
									if(file_exists("./abstract/".$row['by'].".pdf"))
										echo "<td><a href=\"./abstract/".$row['by'].".pdf\" target=_blank>see abstract</a></td>";
									else echo "<td>no abstract</td>";

									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'")>Accept</button>
									
									</td>';
									else
										echo '<td>The project is accepted by '.$row['acceptedby'].'</td>';

								}
								echo "</tr>";

							}
						?>
					</table>
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
							<th>
								Email
							</th>
							<th>
								Contact
							</th>
							<th>
								Hostel/Room
							</th>';
				
							if($manager)
							echo '
							<th>
								Action
							</th>
							';
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td title='".$row['project_desc']."''>".$row['project_name']."</td>";
							
								echo "<td>".$row['t1_name']."</td>";
								echo "<td>".$row['t1_email']."</td>";
								echo "<td>".$row['t1_contact']."</td>";
								echo "<td>".$row['t1_hostel']."</td>";
								if($manager){
									if($row['acceptedby']==""||$row['acceptedby']=="0")
									echo '<td>
									
										<input name="name" placeholder ="name" id="'.$row['by'].'">
										<button class="btn btn-success" onclick=accept("'.$row['by'].'")>Accept</button>
									
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
				
			</article>
			<!-- /Article -->

		</div>
		<script type="text/javascript">
<?php
if($manager)
{
	echo 'function accept(by){
		$.post(\'php/accept.php\',{
				by:by,
				accepter:$("#"+by).val()
			}).done(function(data){
				location.reload();
			})
	}';
}
?>
		</script>
	</div>	<!-- /container -->
	<?php include "downbar.php"; ?>
