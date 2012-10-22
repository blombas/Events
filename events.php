<?php 

	session_start(); 
 	include ('includes/header.php');
 	require ('includes/functions.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		$name = $_POST['name'];
		$_SESSION['username'] = $name;
		$userid = get_user_id($name);
		$user_array = get_user($userid);
		$hcard = get_hcard($user_array);
		$user_event = get_user_event($userid);
	}
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$hcard = array();
		if(!empty($_GET) && $_SESSION['username'] != 'Select a user')
		{
			$my_date = $_GET['date'];
			if(!empty($my_date))
			{
				$userid = get_user_id($_SESSION['username']);
				$date_inserted = insert_event($my_date, $userid);
				$_SESSION['new_event'] = $date_inserted;
			}
		}
	}

 ?>
	<div id="content">
		<div id="events">
			<h3>User events</h3>
			<form action="" method="post">
				<select name="name">
					<option> Select a user</option>
					<?php  
					$users = get_users();
					foreach($users as $array=>$names)
					{
						$value1 = "";
						$value = "";
						foreach($names as $name=>$value)
						{
							if($value != $value1)
							{	
								echo "<option value=\"$value\">$value</option>";
							}
							$value1 = $value;
						}
					}
				  	?>
				</select>
				<input type="submit" value="Go">
			</form><br><br>
			<?php 
			if ($_SESSION['username'] != 'Select a user' && !empty($hcard))
			{
				echo "<h3>List of events for:</h3>" . $hcard;
			}		
			if(!empty($user_event))
			{
				foreach($user_event as $array=>$mydate)
				{
					$value1 = "";
					$value = "";
					foreach($mydate as $mytime=>$value)
					{
						if($value != $value1)
						{	
							echo "<h4>" . $value . "</h4>";
						}
						$value1 = $value;
					}
				}
			}
	 		?>
		</div> <!-- end #events -->
		<div id="newEvent">
			
			<h3>Make a new event</h3>
			<form action="" method="get">
				<label for="date">Datetime: </label>
				<input name="date" id="date" type="datetime"><br><br>
				<input type="submit" value="Create event">
			</form><br><br>
			<?php  
				if($_SESSION['new_event'])
				{
					echo "<h3> Thanks, your new event is registret";
				}
				$_SESSION['new_event'] = false;
			?>

		</div> <!-- end #newEvent -->

		
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>
