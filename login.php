<?php
	$title = "Login";
	session_name("SocialNetwork");
	session_start();
	require_once "./user.php";
	require_once "./lib/dbhelper.php";
	include("./inc/header.php");
	if(isset($_POST["username"])){
		DBHelper::init();
		$user = DBHelper::getUserByUsernameAndPassword($_POST["username"], $_POST['password']);
		if(is_null($user)){
			$errors[] = "Username/Password is invalid.";
		}else{?>
			<?php 
			$_SESSION['user_name'] = $user->user_name;
			//Let's redirect or go to home page
			header("Location: ./second_auth.php");
			return;
		}
	}
	
?>
	<div class="leftContent">
		<?php 
			if(count($errors) > 0){ ?>
			<div>
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
			<div>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" required  />
			</div>
			<div>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required />
			
			</div>
			<div>
				<input type="submit" />
			</div>
		</form>
	</div>
<?php
	include_once("inc/rightContent.php");
	include("inc/footer.php");
?>