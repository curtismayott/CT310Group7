<?php
	// error reporting
	error_reporting(-1);
	ini_set('display_errors', 'On');
	// end error reporting
	$title = "Friend Requests";
	session_name("SocialNetwork");
	session_start();
	require_once "./user.php";
	require_once "./lib/dbhelper.php";
	$dbh = new DBHelper();
	include("./inc/header.php");
	if(!isset($_SESSION['user_name'])){
		header("Location:./login.php");
	}
	$user = $dbh->getUserByUsername($_SESSION['user_name']);
	$friends = $dbh->getPendingFriends($user->user_id, 1);
	$i = 0;
	for($i = 0; $i < count($friends); $i++) {
		if(isset($_POST[$friends[$i]->user_id . '_accept'])){
			$dbh->acceptFriend($user->user_id, $friends[$i]->user_id);
			header("Location:./friend_requests.php");
		}
		if(isset($_POST[$friends[$i]->user_id . '_reject'])){
			$dbh->rejectFriend($user->user_id, $friends[$i]->user_id);
			header("Location:./friend_requests.php");
		}
	}
	$errors = array();
/*
	if(isset($_POST["username"])){
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
*/
?>
<div class="leftContent"><?php
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
	<form method="post" action="./friend_requests.php">
		<?php for($i = 0; $i < count($friends); $i++) {?>
				<p><?php echo $friends[$i]->user_name; ?></p>
				<input type="submit" id="<?php echo $friends[$i]->user_id; ?>_accept" name="<?php echo $friends[$i]->user_id; ?>_accept" value="Accept"/>
				<input type="submit" id="<?php echo $friends[$i]->user_id; ?>_reject" name="<?php echo $friends[$i]->user_id; ?>_reject" value="Reject"/>
		<?php } ?>
	</form>
</div>
<?php
	include_once("inc/rightContent.php");
	include("inc/footer.php");
?>