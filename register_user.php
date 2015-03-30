<?php
	error_reporting(-1);
	ini_set('display_errors', 'On');
	$title = "Register User";
	session_name("SocialNetwork");
	session_start();
	require_once "./user.php";
	require_once "./lib/dbhelper.php";
	$dbh = new DBHelper();
	$_SESSION['location'] = "register_user";
	if(!isset($_SESSION['user_name']) || !$dbh->isAdmin($_SESSION['user_id'])){
		header("Location: ./login.php");
	}
	include("./inc/header.php");
	?><div class="leftContent"><?php
	$errors = array();
	if(isset($_POST['username'])){
		// $user_id = '1', $user_name = '', $user_type = 'user', $first_name = '', $last_name = '', 
		// $password = '', $question_id = 1, $question_answer = '', $logged_in_status = 0
		$dbh->insertUser(
			$_POST['username'],
			$_POST['usertype'],
			$_POST['firstname'],
			$_POST['lastname'],
			$_POST['password'],
			$_POST['question'],
			$_POST['questionanswer'],
			0
		);
	}
	
?>

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
		<form method="post" action="./register_user.php">
			<div>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" required  />
			</div>
			<div>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" required />
			</div>
			<div>
				<label for="usertype">User Type:</label>
				<select id="usertype" name="usertype" required>
					<option value="user">User</option>
					<option value="admin">Admin</option>
				</select>
			</div>
			<div>
				<label for="firstname">First Name:</label>
				<input type="text" id="firstname" name="firstname" required  />
			</div>
			<div>
				<label for="lastname">Last Name:</label>
				<input type="text" id="lastname" name="lastname" required  />
			</div>
			<div>
				<label for="question">Question:</label>
				<select name="question">
					<option value="">Select</option>
					<?php
					$count = 1;
					$questions = $dbh->getQuestionArray();
					foreach($questions as $question){?>
						<option value="<?php echo $count; ?>"><?php echo $question; ?></option>;
						<?php $count++;
					}
					?>
				</select>
			</div>
			<div>
				<label for="questionanswer">Question Answer:</label>
				<input type="text" id="questionanswer" name="questionanswer" required  />
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