<?php 
	session_start();
	include ('includes/header.php'); 
	require ('includes/functions.php');

	$login_text = "Please login";
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$username = $_POST['email'];
		$password1 = $_POST['password'];
		$user = get_user_from_mail($username);
		if(!empty($user))
		{
			extract($user);
			$hash = hash('sha256', $password1 . $phone);
			if($hash == $password)
			{
				$_SESSION['username'] = $name;
				$login_text = "You are logged in";
			}
			else
			{
				$login_text = "Username or password does not match our records";
			}
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
			<input type="text" id="email" name="email" title="Email" value="email"><br><br>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" title="Password" value=""><br>
			<input type="submit" value="Login" />
		</form>
		</div>
		
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>


