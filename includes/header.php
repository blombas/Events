<!DOCTYPE html >
<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<link rel="stylesheet" type="text/css" href="./style.css" media="screen" />
	<title>Give me a call</title>

</head>
<body>

    <div id="wrapper">

		<div id="header">
			<?php 
			if(isset($_SESSION['loggedin']))
			{
				echo "<p id=\"username\"> Welcome " . htmlspecialchars($_SESSION['username']) . "</p>"; 
			}
			?>
			<h2>Give me a call</h2>
		</div> <!-- end #header -->

		<div id="nav">

			<a href="index.php">Home</a>
		    <a href="signup.php">Sign up</a>
		    <a href="events.php">Events</a>
		    <a href="mail.php">Mail</a>

		</div> <!-- end #nav -->