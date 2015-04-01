<?php
	include_once("./lib/config.php");
	include_once("./lib/util.php");
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
	<header class = "container-fluid">
		<div class = "row">
			<img class = "col-lg-2 col-md-2 hidden-xs" id = "logo" src = "assets/img/logo.gif">
			<div class = "col-md-6">
			<h2>Group 7 Social Network </h2> <br>
			<h4> >> <?php echo " " . $title; ?> </h4>
			</div>
			<div class = "col-md-4">
				<nav>
				<ul>
					<li><a id="home-nav" href="index.php">HOME</a></li>
					<li><a id="search-page" href="search.php?user=leonardovolpatto">SEARCH PAGE</a></li>
					<!-- <li><a href="#">CONTACT</a></li> -->
					<?php 
						if(isset($_SESSION['user_name']) && $dbh->isAdmin($_SESSION['user_id']) && $dbh->isUserLoggedIn($_SESSION['user_id'])){
						// add link to register users (isAdmin = true)
							?>
							<li><a id="register-user" href="./register_user.php">Register</a></li>
							<?php
					}?>
					<?php
						if(isset($_SESSION['user_name']) && $dbh->isUserLoggedIn($_SESSION['user_id'])){
							?>
							<li>Logged in as <a id="logout" href="./logout.php"><?php echo $_SESSION['user_name']; ?></a></li>
							<?php
						}else{
							?>
							<li><a id="login" href="./login.php">Login</a>
							<?php
						}
					?>
				</ul>
				</nav>
			</div>
		</div>	
	</header>
	<main>
		