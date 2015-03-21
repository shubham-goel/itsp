<?php

include "php/dbconnect.php";

include "header.php";
echo '
<style>
.comment{
	min-height:100px;
}
td{
	margin:1px;
	border:1px solid #ccc;

}
</style>
';
echo '<table class="table">
					<th>Team id</th>
							<th>
								Team Name
							</th>
							<th>
								Mentor 1
							</th>
							<th>
								Mentor 2
							</th>
							<th>
								Mentor 3
							</th>
							<th>
								Manager
							</th>
							';
							$q=mysqli_query($con,"select * from itsp_project where `club` !='umic' && t1_roll!='outsider' && slot=1 order by club");
							while($row=mysqli_fetch_assoc($q))
							{
								echo "<tr>";
								echo "<td>".$row['team_id']."</td>";
								echo "<td>".$row['team_name']."</td>";
								echo "<td><div class='comment'>".$row['mentor1']."</div></td>";
								echo "<td><div class='comment'>".$row['mentor2']."</div></td>";
								echo "<td><div class='comment'>".$row['mentor3']."</div></td>";
								echo "<td><div class='comment'>".$row['manager']."</div></td>";
								echo '</tr>';
							}
						echo '</table>';

?>