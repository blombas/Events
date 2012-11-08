<?php
	session_start();
	include ('includes/header.php');
	require('includes/functions.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(in_array(null, $_POST))
		{
			$welcome_text = ' you have to fill out all fields to sign up';
		}
		else if ($_POST['password1'] != $_POST['password2'])
	 	{
			$welcome_text = "Your have a mismatch in your password, please type your password again";
		}
		else
		{
			$hash = hash('sha256', $_POST['password1'] . $_POST['phone']);
			insert_user($_POST, $hash);
			$welcome_text = ' Welcome, you have signed up, now go and login.';
		}
	}
?>

	<div id="content">
		<div id="signup">

			<form action="" method="post">
				<ul>
					<li>
						<label for="name">Name : </label>
						<input input="text" name="name" id="name" autocomplete="off">
					</li>
					<li>
						<label for="email">Email : </label>
						<input input="text" name="email" id="email" autocomplete="off">
					</li>
					<li>
						<label for="phone">Phone: </label>
						<input input="text" name="phone" id="phone" autocomplete="off">
					</li>
					<li>
						<label for="password1">Password: </label>
						<input type="password" name="password1" id="password1" autocomplete="off">
					</li>
					<li>
						<label for="password2">Password again: </label>
						<input type="password" name="password2" id="password2" autocomplete="off">
					</li>
					<li>
						<input type="submit" value="Sign up">
					</li>
				</ul>
			</form>

			<h3 id="info_message">
				<?php if(!empty($welcome_text)) {echo $welcome_text; } ?>
			</h3>

		</div> <!-- end #sigup -->
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>