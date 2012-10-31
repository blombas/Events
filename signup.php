<?php
	include ('includes/header.php');
	require('includes/functions.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		insert_user($_POST);
		if(in_array(null, $_POST))
		{
			$welcome_text = ' you have to fill out the form to sign up';
		}
		else
		{
			$welcome_text = ' Welcome, you have signed up :-)';
		}
	}
	
?>

	<div id="content">
		<div id="signup">

			<form action="" method="post">
				<ul>
					<li>
						<label for="name">Name : </label>
						<input input="text" name="name" id="name">
					</li>
					<li>
						<label for="email">Email : </label>
						<input input="text" name="email" id="email">
					</li>
					<li>
						<label for="phone">Phone: </label>
						<input input="text" name="phone" id="phone">
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