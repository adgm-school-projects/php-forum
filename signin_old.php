<?php
session_start();
include 'header.php';
include 'connect.php';

echo '<h2>Sign In.</h2>';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == TRUE)
{
	echo 'You are already signed in. You can <a href="signout.php">Sign Out</a> if you want.';
}
else
{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		echo '<form action="signin.php" method="POST">
		<p>Username: <input type="text" name="user_name"></p>
		<p>Password: <input type="password" name="user_pass"></p>
		<p><input type="submit" value="Sign In!"></p>
		</form>';
	}
	else
	{
		$errors = array();
		$username = trim(strip_tags($_POST['user_name']));
		$userpass = trim(strip_tags($_POST['user_pass']));
		
		if(!isset($username))
		{
			$errors[] = 'The username field must not be empty.';
		}
		
		if(!isset($userpass))
		{
			$errors[] = 'The password field must not be empty.';
		}
		
		if(!empty($errors))
		{
			echo 'Some fields were not filled in correctly.';
			echo '<ul>';
			foreach($errors as $key => $value)
			{
				echo '<li>' . $value . '</li>';
			}
			echo '</ul>';
			echo '<a href="signin.php">Back.</a>';
		}
		else
		{
			$sql = "SELECT
						user_id,
						user_name,
						user_level
					FROM
						forum_users
					WHERE
						user_name = '$username'
					AND
						user_pass = '" . sha1($userpass) . "'";
			
			$result = mysqli_query($dbc, $sql);
			if(!$result)
			{
				echo 'Something went wrong. Please try again.' . mysqli_error($dbc);
			}
			else
			{
				if(mysqli_num_rows($result) == 0)
				{
					echo 'You have provided the wrong username/password combination. Please try again';
				}
				else
				{
					$_SESSION['signed_in'] = TRUE;
					while($row = mysqli_fetch_assoc($result))
					{
						$_SESSION['user_id'] = $row['user_id'];
						echo $_SESSION['user_id'];
						$_SESSION['user_name'] = $row['user_name'];
						echo $_SESSION['user_name'];
						$_SESSION['user_level'] = $row['user_level'];
						echo $_SESSION['user_level'];
					}
					echo '<pre>';
					print_r($_SESSION);
					echo '</pre>';
					
					echo 'Welcome, ' . $row['user_name'] . '. <a href="index.php">Proceed to the Forums.</a>';
				}
			}
		}
	}
}
?>