<?php
include 'header.php';
include 'connect.php';
 
echo '<h2>Create Topic</h2>';

/* Check if user is signed in before they can create a topic */
if(($_SESSION['signed_in']) == FALSE)
{
	echo 'Sorry you have to <a href="signin.php">Sign In</a> first to create a Topic.';
}
else
{
	/* Check if post request has been made */
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
	/* Grab category details for use in a drop-down */
		$sql = "SELECT cat_id, cat_name, cat_description FROM categories";
		$result = mysqli_query($dbc, $sql);
		
		if(!$result)
		{
			echo 'Error while selecting from the database. Please try again.';
		}
		else
		{
			if((mysqli_num_rows($result)) == 0)
			{
				echo 'There have not been any categories created yet.';
			}
			else
			{
				/* Creates a form for adding Topic post in a specific Category */
				echo '<form action="create_topic.php" method="POST">
						<p>Subject: <input type="text" name="topic_subject"></p>
						<p>Category: <select name="topic_cat">';
							while($row = mysqli_fetch_assoc($result))
							{
								echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
							}
				echo '</select></p>';
				echo '<p>Message: <textarea name="post_content"></textarea></p>
						<input type="submit" value="Submit Topic">
						</form>';
			}
		}
	}
	else
	{
		$query = "BEGIN WORK;";
		$result = mysqli_query($dbc, $query);
		
		if(!$result)
		{
			echo 'An error occurred while trying to create your Topic. Please try again.';
		}
		else
		{
			/* Insert new Topic post into topics table. */
			$sql = "INSERT INTO
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . mysqli_real_escape_string($dbc, $_POST['topic_subject']) . "',
                               NOW(),
                               " . mysqli_real_escape_string($dbc, $_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               )";
			$result = mysqli_query($dbc, $sql);
			if(!$result)
			{
				echo 'An error occurred while inserting your data. Please try again later. MySQLi Error: ' . mysqli_error($dbc);
				$sql = "ROLLBACK;";
				$result = mysqli_query($dbc, $sql);
			}
			else
			{
				$topic_id = mysqli_insert_id($dbc);
				$post_content = $_POST['post_content'];
				$post_by = $_SESSION['user_id'];
				
				$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by)
						VALUES('$post_content', NOW(), '$topic_id', '$post_by')";
						
				$result = mysqli_query($dbc, $sql);
				
				if(!result)
				{
					echo 'An error occurred while inserting your post. Please try again';
					$sql = "ROLLBACK;";
					$result = mysqli_query($dbc, $sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = mysqli_query($dbc, $sql);
					
					echo 'You have successfully created <a href="topic.php?id=' . $topic_id . '">your new topic</a>.';
				}
			}
		}
	}
}
include 'footer.php';
?>