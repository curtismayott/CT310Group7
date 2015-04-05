<!--
Session information:
session_name = 'SocialNetwork'
session's username storage key = 'user_name'
session's userid storage key = 'user_id'
session's location user is visiting (for login redirecting) = 'location'
session's start time : 'starttime'
$dbh must be created before including header
-->

<?php
	// error reporting
	error_reporting(-1);
	ini_set('display_errors', 'On');
	// end error reporting
	$title = "Login";
	session_name("SocialNetwork");
	session_start();
	require_once "./user.php";
	require_once "./lib/dbhelper.php";
	$dbh = new DBHelper();
	include("./inc/header.php");
	$errors = array();
?><div class="leftContent"><?php
	if(isset($_POST["username"])){
		print_r($_POST['username'] . " " . $_POST['password']);
		$dbh->init();
		$user = $dbh->getUserByUsernameAndPassword($_POST["username"], $_POST['password']);
		if(is_null($user)){
			$errors[] = "Username/Password is invalid.";
		}else{?>
			<?php 
			$_SESSION['user_name'] = $user->user_name;
			$_SESSION['user_id'] = $user->user_id;
			//Let's redirect or go to home page
			header("Location: ./second_auth.php");
			return;
		}
	}
	
?>

		<?php 
			if(count($errors) > 0){ ?>
			<div class="alert alert-danger">
			<h4>Please fix the following errors.</h4>
				<ul>
					<?php 	
						//This for each will load the key of the
						//array into the $field variable and the value
						//into the $error variable
						foreach($errors as $field => $error){
							echo "<li>$error</li>";
						}
					?> 
				</ul>
			</div>
		<?php		
			} //End if count($errors);
		?>
		<form method="post" action="./login.php">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" required  />
			</div >
			<div class="form-group">
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required />
			
			</div>
			
				<input type="submit" class="btn btn-info"/>
			
		</form>
	</div>
<?php
	include_once("inc/rightContent.php");
	include("inc/footer.php");
?>