			<div class="rightContent col-md-4">
				<h3>Users</h3>
				<?php
				$helper = new DBHelper();
				$numUsers = $helper->getNumberUsers();
				echo "<p>All members: $numUsers people </p>";
				$userArray = $helper->getAllUsers();
				?>
				
				<table class="table table-hover">
					<?php
					//<ul class="list-unstyled"></ul>
					foreach($userArray as $u){
						echo "<tr>";
						$href = "profile.php?user=$u->user_name";
						//$src = getImageByUsername($u->user_name);
						//echo "<td> <img src = \"$src\" alt = \"$u->user_name\"> </td>";
						echo "<td> <a href = \"$href\"> $u->user_name </a> </td>";
						if($u->logged_in_status == 1){ //logged in
							echo "<td> <img src=\"assets/img/dot.gif\">online </td>";
						}else{
							echo "<td>  </td>";
						}
						echo "</tr>";
					}
					?>
				</table>

				<?php	
					if(isset($_SESSION['starttime'])){
						echo "<h3>Friends</h3>";
						$friends = $helper->getFriendsByUserID($_SESSION['user_id']);
						if($friends != NULL){
							echo "<table class=\"table table-hover\">";
							foreach($friends as $f){
								echo "<tr>";
								$href = "profile.php?user=$f->user_name";
								echo "<td> <a href = \"$href\"> $f->user_name </a></td>";
								if($f->logged_in_status == 1){ //logged in
									echo "<td> (online) </td>";
								}else{
									echo "<td>  </td>";
								}
								echo "</tr>";
							}
					
							echo "</table>";
						}
					}  

				/*
				ul style
				<ul class="list-unstyled">
				<?php
				foreach($userArray as $u){
					$href = "profile.php?user=$u->user_name";
					echo "<li> <a href = \"$href\"> $u->user_name </a>";
					if($u->logged_in_status == 1){ //logged in
						echo " (online)";
					}
					echo "</li>";
				}
				?>
				</ul>
				
				<?php	
					if(isset($_SESSION['starttime'])){
						echo "<h2>Friends</h2>";
						$friends = $helper->getLoggedInFriends($_SESSION['user_id']);
						echo "<ul class=\"list-unstyled\">";
						foreach($friends as $f){
							$href = "profile.php?user=$f->user_name";
							echo "<li> <a href = \"$href\"> $f->user_name </a></li>";
						}
				
						echo "</ul>";
					
					}  

*/
				?>
			</div>
			<div class="clear"></div>