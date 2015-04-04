<?php
	session_name("SocialNetwork");
	session_start();
	
	error_reporting(-1);
	ini_set('display_errors', 'On');
	$title = "Log out";
	
	require_once "./user.php";
	require_once "./lib/dbhelper.php";
	$dbh = new DBHelper();
	$dbh->updateUserLoggedInStatus($_SESSION['user_id'], 0);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_id']);
	unset($_SESSION['starttime']);
	session_destroy();
	include("./inc/header.php");
?>

	<div class="leftContent">
		<p>Logout Successful.</p>
	</div>
<?php
	include_once("inc/rightContent.php");
	include("inc/footer.php");
?>