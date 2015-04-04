<?php
	// need a way to determine if logged in user is the correct user to be able to edit this page.
	// need to add option to edit auth question in this location
	$title = "Edit Profile";
	error_reporting(-1);
	ini_set('display_errors', 'On');
	// end error reporting
	$title = "Login";
	session_name("SocialNetwork");
	session_start();
	require_once "./user.php";
	require_once "./lib/dbhelper.php";
	$dbh = new DBHelper();
	if(!isset($_SESSION['user_name']) && !$dbh->isUserLoggedIn($_SESSION['user_id'])){
		// cannot view edit page if not logged in
		header('Location:./login.php');
	}
	include("./inc/header.php");
	$errors = array();
?>
	<div class="leftContent"><?php
		if ($userName == "") {
			echo '<h2>Profile not found!</h2>';
		} else {
			$file = new files("users");
			
			if ($file->exists()) {
				$fileContents = $file->readFile();
				$userInfo = $fileContents[$userName-1];
				
				if(isset($_POST['message']) && isset($_POST['name'])){
					$description = util::sanitizeData($_POST['message']);
					$fullName = util::sanitizeData($_POST['name']);
					
					$fullName = explode(' ', $_POST['name']);
					
					$name = $fullName[0];
					$lastName = "";
					
					if (count($fullName) > 2) {
						unset($fullName[0]);
						$lastName = join(' ', $fullName);
					} else {
						$lastName = $fullName[1];
					}
					
					$fileContents[$userName-1][1] = $name;
					$fileContents[$userName-1][2] = $lastName;
					$fileContents[$userName-1][3] = $description;
					
					$isSaved = $file->writeFile($fileContents);
				}
				
				$fileContents = $file->readFile();
				$userInfo = $fileContents[$userName-1];

				echo '<h2>' . $userInfo[1] . ' ' . $userInfo[2] . '</h2>';
				echo '<img class="profile-pic" src="assets/img/profile'. $userName . '.jpg" alt="' . $fileContents[0][2] . '\'s image profile">';
				$description = $userInfo[3];
				
				echo '<div class="wrap-textarea">';
				echo '<form id="form1" name="form1" method="post" action="profileEdit.php?user=' . $userName . '">';
				echo '<label for="name">Name</label>';
				echo '<input type="text" id="name" name="name" value="' . $userInfo[1] . ' ' . $userInfo[2] . '"/>';
				echo '<label for="message">Description</label>';
				echo '<textarea name="message" id="message" rows="25" cols="50">';

				echo $description;

				echo '</textarea>';
				echo '<input type="submit" name="button" id="button" value="Save"/>';
				echo '<a href="profile.php?user=' . $userName . '" >Go back</a>';
					
				if (isset($isSaved) && $isSaved){ 
					echo '<div class="save-success"><h4>Successfully saved!</h4></div>';
				}
				echo '</form></div>';

			} else {
				echo '<h2>Profile not found!</h2>';
			}
		}
		?>

		<hr/>
	</div>
	
	
	<?php
		
	?>
			

<?php
	include_once("inc/rightContent.php");
	include_once("inc/footer.php");
?>