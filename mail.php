<?php 
	session_start();
	include ('includes/header.php'); 
	require ('includes/functions.php'); ?>

	<div id="content">
		<?php

			$result = get_zero();	// get all events in state zero
			foreach($result as $id => $value) 
			{
				$start_date = new DateTime($value[1]);
				$now_diff = $start_date->diff(new DateTime('now'));
				if($now_diff->y == 0 && $now_diff->m == 0 && $now_diff->d == 0 && $now_diff->h == 0 && $now_diff->i < 2)
				{
					set_state($value[2], 1);
					echo "Event (id = " . $value[2] . ") is set to state 1 <br>";
					$user = get_user($value[0]);
					send_mail($user[2], 1);
					echo "mail has been sendt <br>";
					set_state($value[2], 2);
					echo "Event (id = " . $value[2] . ") is set to state 2 <br><br><br>";
				}
			}			
		?>
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>