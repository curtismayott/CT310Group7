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
	<header>
		<div id="page-logo">
			<a href="index.php">
				<div id="link-to-home">
					<h1>Group 7 Altered - Social Network<br/></h1>
					<h2><?php echo $title; ?></h2>
				</div>
			</a>
		</div>	
		<nav>
			<ul>
				<li><a id="home-nav" href="index.php">HOME</a></li>
				<li><a id="search-page" href="search.php?user=leonardovolpatto">SEARCH PAGE</a></li>
				<!-- <li><a href="#">CONTACT</a></li> -->
			</ul>
		</nav>
		
<!-- 		<div class="page-info">
			<h1><?php echo $title; ?></h1>
		</div> -->	

		
	</header>