<?php
include 'header.php';
include 'connect.php';

print '<h2>Sign Up!</h2>';

/* Check if form post submitted, if not, print form. */
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	// Sign-Up form.
	echo '<form action="signup.php" method="POST">
		<p>Username: <input type="text" name="user_name"></p>
		<p>Password: <input type="password" name="user_pass"></p>
		<p>Retype Password: <input type="password" name="password_check"></p>
		<p>Email: <input type="email" name="user_email"></p>
		<p><input type="submit" value="Sign Up!"></p>
		</form>';
}
else {
	$errors = array(); 	// Create an array for errors in the form.
	$username = trim(strip_tags($_POST['user_name']));
	$userpass = trim(strip_tags($_POST['user_pass']));
	$useremail = trim(strip_tags($_POST['user_email']));
	
	// Check if username field is not empty, is alphanumeric, and < 30 chars.
	if(isset($username))
	{
		if(!ctype_alnum($username))
		{
			$errors[] = 'The Username can only contain letters and digits.';
		}
		if(strlen($username) > 30)
		{
			$errors[] = 'The Username must be less than 30 characters.';
		}
	}
	else
	{
		$errors[] = 'The Username field must not be empty';
	}
	
	// Check if password fields match.
	if(isset($userpass))
	{
		if($userpass != $_POST['password_check'])
		{
			$errors[] = 'The passwords did not match';
		}
	}
	else
	{
		$errors[] = 'The password field cannot be empty';
	}
	
	// Print a list of any errors added to $errors array.
	if(!empty($errors))
	{
		echo 'Some fields were not filled in correctly.';
		echo '<ul>';
		foreach($errors as $key => $value)
		{
			echo '<li>' . $value . '</li>';
		}
		echo '</ul>';
		echo '<a href="signup.php">Back.</a>';
	}
	else
	{
		// User form values are inserted into forum_users table.
		$sql = "INSERT INTO forum_users(user_name, user_pass, user_email, user_date, user_level)
				VALUES('$username', '" . $userpass . "', '$useremail', NOW(), 0)";
		
		$result = mysqli_query($dbc, $sql);
		if(!$result)
		{
			echo 'Something went wrong. Please try again later.' . mysqli_error($dbc);
		}
		else
		{
			echo 'Thank you, ' . $username . '. You have successfully registered. You can <a href="signin.php">Sign In</a> and start posting.';
		}
	}
}

include 'footer.php';
?>