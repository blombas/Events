<?php 
	session_start();
	include ('includes/header.php'); 
	require ('includes/functions.php');
	// gets saved hash password from db
	// match it against the one the user has entered
	// after it has been hashed and salted.
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(!empty($_POST['logout']))
		{
			session_destroy();
			header('Location: index.php');
		}
		else
		{
			$username = $_POST['email'];
			$password1 = $_POST['password'];
			$user = get_user_from_mail($username);
			if(!empty($user))
			{
				extract($user);									// extract userdata from db (incl password)
				$hash = hash('sha256', $password1 . $phone);	// hash the password user entered in login form using same salt
				if($hash == $password && $email == $username)	// see if they match and with the right username
				{
					$_SESSION['username'] = $name;
					$_SESSION['loggedin'] = true;
					header('Location: index.php');
				}
			}
		}
	}

	if(!isset($_SESSION['loggedin']))
	{
		$login_text = "Please login";
	}
	else
	{
		$login_text = "You are logged in";
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
		<input type="text" id="email" name="email" title="Email" value="" autocomplete="off"><br><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" title="Password" value="" autocomplete="off"><br>
		<input type="submit" value="Login" />
		</form>

		<form action="" method="post">
		<input type="hidden" name="logout" value="logout">
		<input type="submit" value="Logout"/>
		</form>

		</div>
		
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>


