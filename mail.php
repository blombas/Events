<?php include ('includes/header.php'); 
require ('includes/functions.php'); ?>

	<div id="content">

		<?php
		/*$start_date = new DateTime('2012-10-22 14:10:58');
		$now_diff = $start_date->diff(new DateTime('now'));
		echo $now_diff->days.' days total<br>';
		echo $now_diff->y.' years<br>';
		echo $now_diff->m.' months<br>';
		echo $now_diff->d.' days<br>';
		echo $now_diff->h.' hours<br>';
		echo $now_diff->i.' minutes<br>';
		echo $now_diff->s.' seconds<br>';*/

			$result = get_zero();
			foreach($result as $id => $value) 
			{
				$start_date = new DateTime($value[1]);
				$now_diff = $start_date->diff(new DateTime('now'));
				if($now_diff->i < 2)
				{
					echo $now_diff->i;	
				}
				
			}			
			
		

		?>
	</div> <!-- end #content -->

<?php include ('includes/footer.php') ?>