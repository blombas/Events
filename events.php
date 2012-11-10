<?php 

	session_start(); 
 	include ('includes/header.php');
 	require ('includes/functions.php');
 	$_SESSION['event_created'] = false;
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$my_date = $_POST['date'];
		if(!empty($my_date) && isset($_SESSION['loggedin']))
		{
			$userid = get_user_id($_SESSION['username']);
			$date_inserted = insert_event($my_date, $userid);
			$_SESSION['new_event'] = $date_inserted;
			$_SESSION['event_created'] = true;
		
			$userid = get_user_id($_SESSION['username']);
			$user_array = get_user($userid);
			$hcard = get_hcard($user_array);
			$user_event = get_user_event($userid);	
		}
		else if(empty($my_date))
		{
			echo "<p style=\"color:red;\">You need to insert a date </p>";
		}
		else
		{
			echo "<p style=\"color:red;\">Please login to see your events </p>";
		}
		
		
	}
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if(isset($_SESSION['loggedin']))
		{
			$userid = get_user_id($_SESSION['username']);
			$user_array = get_user($userid);
			$hcard = get_hcard($user_array);
			$user_event = get_user_event($userid);	
		}
		else
		{
			echo "<p style=\"color:red;\">Please login to see or create events.</p>";
		}	
	}

 ?>
	<div id="content">
		<div id="events">
			<h3>User events</h3>
			
			<?php 
			if (!empty($_SESSION['username']) && !empty($hcard))
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
							echo "<h4>" . htmlspecialchars($value) . "</h4>";
						}
						$value1 = $value;
					}
				}
			}
	 		?>
		</div> <!-- end #events -->
		<div id="newEvent">
			
			<h3>Make a new event</h3>
			<form action="" method="post">
				<label for="date">Datetime: </label>
				<input name="date" id="date" type="datetime"><br><br>
				<input type="submit" value="Create event">
			</form><br><br>
			<?php  
				if($_SESSION['event_created'] == true)
				{
					echo "<h4> Thanks, your new event is registret </h4>";
				}
				$_SESSION['new_event'] = false;
				$_SESSION['event_created'] = false;
			?>
			<?php
			 $today = new Datetime('now');
			 $today = $today->format('Y-m-d H:i:s');
			 echo '<h3> current datetime is: ' . $today . "</h3>";
			 ?>
		</div> <!-- end #newEvent -->

		
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>
