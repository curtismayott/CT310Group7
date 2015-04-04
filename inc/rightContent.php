			<div class="rightContent col-md-4">
				<h2>Users</h2>
				<?php
				$helper = new DBHelper();
				$numUsers = $helper->getNumberUsers();
				echo "<p>All members: $numUsers people </p>";
				$userArray = $helper->getAllUsers();
				?>
				
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

				/*
				$file = new files("users");
				$userlist = "";	
				if ($file->exists()) {
					$userlist = $file->readFile();
				} else{
					print_r("ERROR");
				}
				$i = 1;
				
				echo '<div class="user-list">';

				foreach($userlist as $user) {
					echo '<div class="profile-thumb">
									<a href="profile.php?user=' . $i . '">
										<img src="assets/img/profile' . $i++ . '.jpg" alt="profile"/>
										<span>' . $user[1] . '</span>
									</a>
							</div>';
							
							//if ($i == 3) break; // Just 2 profiles per page
				}

				echo '</div>';
*/
				?>

			</div>