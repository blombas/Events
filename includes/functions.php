<?php 
if(!function_exists('insert_user'))
{	
	function insert_user($post)
	{
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
		  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO users VALUES("", :name, :email, :phone)');
	  		$stmt->execute(array(
	    		':name' => $post['name'],
				':email'=> $post['email'],
	    		':phone' => $post['phone'] ));
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}

	}
}

if(!function_exists('insert_event'))
{	
	function insert_event($date, $id)
	{
		try
		{
			$email_state = 0;
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
		  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO events VALUES("", :my_date, :user_id, :state)');
	  		$stmt->execute(array(
	    		':my_date' => $date,
				':user_id'=> $id,
				'state'=> $email_state ));
	  		return true;
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}
		return false;
	}
} 

if(!function_exists('get_users'))
{	
	function get_users()
	{
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
		  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('select name from users');
	  		$stmt->execute();
	  		return $stmt->fetchAll();  		
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}
	}
}

if(!function_exists('get_user'))
{
	function get_user($id)
	{
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('select * from users where id = :my_user');
			$stmt->bindParam(':my_user', $id, PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch();
			return $row;
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}
	}
}

if(!function_exists('get_user_id'))
{	
	function get_user_id($name)
	{
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
		  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('select id from users where name = :name');
	  		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	  		$stmt->execute();
	  		$row = $stmt->fetch(); 
	  		$id = $row[0];
	  		return $id;		
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}
	}
}

if(!function_exists('get_user_event'))
{	
	function get_user_event($id)
	{
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
		  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('select datetime from events where user_id = :id order by datetime');
	  		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	  		$stmt->execute();
	  		$row = $stmt->fetchAll(); 
	  		return $row;		
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}
	}
}

if(!function_exists('get_hcard'))
{
	function get_hcard($user_array)
	{
		extract($user_array);
		$hcard = <<<EOT
			<div class="vcard">
			<span class="fn"> $name </span><br>
			<span class="email"> Email: $email</span><br>
			<span class="tel">Phone: $phone</span>
			</div>
EOT;
		return $hcard;
	}
}

if(!function_exists('get_zero'))
{	
	function get_zero()
	{
		try
		{
			$conn = new PDO('mysql:host=localhost;dbname=event_db', 'root', 'root');
		  	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('select id from events where email_state = 0');
	  		$stmt->execute();
	  		return $stmt->fetchAll();		
		}
		catch(PDOException $e)
		{
			echo 'Error: ' . $e->getMessage();
		}
	}
}

?>
