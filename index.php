<?php 
	session_start();
	include ('includes/header.php'); 
	require ('includes/functions.php');
	if($_SESSION['loggedin'] = false && $_SESSION['username'] != "")
	{
		$login_text = "Please login";
	}
	else
	{
		$login_text = "You are logged in";
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['email'];
		$password1 = $_POST['password'];
		$user = get_user_from_mail($username);
		if(!empty($user))
		{
			extract($user);
			$hash = hash('sha256', $password1 . $phone);
			if($hash == $password && $email == $username)
			{
				$_SESSION['username'] = $name;
				$_SESSION['loggedin'] = true;
				header('Location: index.php');
			}
			else
			{
				$login_text = "Username or password do not match";
			}
		}
		else
		{
			$login_text ="User does not exist";
		}
	}
	?>

	<div id="content">

		<div class="home">
		<h2>Never again forget something important.</h2>
		<p>Let us know of your events, and we will sms or write an email to you</p>
		<img src="images/call.jpeg" alt="give me a call">
		</div>

		<div class="login">
		<h4>
		<?php echo $login_text; ?>
		</h4>
		<form action="" method="post">
			<label for="email">Email:</label>
			<input type="text" id="email" name="email" title="Email" value="email" autocomplete="off"><br><br>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" title="Password" value="" autocomplete="off"><br>
			<input type="submit" value="Login" />
		</form>
		</div>
		
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>


