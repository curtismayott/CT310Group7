<?php
    session_name("SocialNetwork");
	session_start();
	$title = "Verify";
	include "./header.php";
	require_once './users.php';
	require_once './dbhelper.php';
	$errors = array();
	$dbh = new DBHelper();
	$user = $dbh->getUserByUsername($_SESSION['user_name']);
	
	if(isset($_POST["answer"])){
		//Check username password combo
		//Only return simple error. Do you know
		//why not say "username not found" or
		//"password not valid"?
		
		
		
		//User::readUsers(); 
		if(!$dbh->verifyUserByQuestion($user->user_name, $_POST['answer'])){
			$errors[] = "Answer is not correct.";
		}else{
			$_SESSION['starttime'] = time();
			if(isset($_SESSION['location'])){
				$loc = $_SESSION['location'];
				unset($_SESSION['location']);
				header("Location: ./" . $loc . ".php");
				return;
			}else{
				header("Location: ./index.php");
			}
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
		<form method="post" action="./second_auth.php">
			<div>
				<label for="answer"><?php echo $dbh->getQuestionByID($user->question_id); ?></label>
				<input type="text" id="answer" name="answer" required  />
			</div>
			<div>
				<input type="submit" />
			</div>
		</form>
	</div>

<?php
	include "./footer.php";
?>