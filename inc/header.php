<?php
	include_once("./lib/config.php");
	include_once("./lib/dbhelper.php");
	include_once("./lib/util.php");
	require_once "./user.php";
	$dbh = new DBHelper();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="UTF-8">
	 <meta name="author" content="" />
	 <meta name="description" content="" />
	 <meta name="keywords" content="" />
	 <link href="http://www.cs.colostate.edu/~ct310/yr2015sp/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 <title><?php echo $title ?> -  Social Network</title>
	 <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
<div id = "wrap">
	<header class = "container-fluid" >
		<div class = "row">
			<div class = "col-lg-1 col-md-1 hidden-xs">
				<a href="index.php"> <img id = "logo" src = "assets/img/logo.gif" alt="dog logo"> </a>
			</div>
			<div class = "col-md-7">
				<a href="index.php"> <h2>PomerFurball </h2> </a><br><br>
				<h4>  <?php echo "  the Social Network >> " . $title; ?> </h4>
			</div>
			<div class = "col-md-4">
				<nav>
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="search.php">SEARCH</a></li>
					
					<?php
						if(isset($_SESSION['user_name']) && $dbh->isUserLoggedIn($_SESSION['user_id'])){
							$pending = $dbh->getPendingFriends($_SESSION['user_id'], 1);
							if(count($pending) > 0){
								?>
								<li><a id="friend-requests" href="./friend_requests.php">Requests</a></li>
								<?php
							}
						}
						if(isset($_SESSION['user_name']) && $dbh->isAdmin($_SESSION['user_id']) && $dbh->isUserLoggedIn($_SESSION['user_id'])){
						// add link to register users (isAdmin = true)
							?>
							<li><a id="register-user" href="./register_user.php">Register</a></li>
							<?php
					}?>
				
					<?php
						if(isset($_SESSION['user_name']) && $dbh->isUserLoggedIn($_SESSION['user_id'])){
							?>
							</ul>
							<ul>
								<li>Logged in as <a href="profile.php?user=<?php echo $_SESSION['user_name'];?>">
								<?php echo $_SESSION['user_name'];?></a></li>
								<li><a href="./logout.php">Log out </a></li>
							<?php
						}else{
							?>
							<li><a href="./login.php">Login</a>
							<?php
						}
					?>
				</ul>
				</nav>
			</div>
		</div>	
	</header>
	<main>
		<div class = "content">
		