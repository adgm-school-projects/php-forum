<?php
include 'connect.php';
include 'header.php';

$sql = "SELECT topics_id, topic_subject FROM topics WHERE topics.topics_id = " . $_GET['id'];

$result = mysqli_query($dbc, $sql);

if(!$result)
{
	echo 'The topic could not be displayed. Please try again later.';
}
else
{
	if((mysqli_num_rows($result)) == 0)
	{
		echo 'This topic does not exist';
	}
	else
	{
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<h2>Posts in "' . $row['topic_subject'] . '"</h2>';
		}
		
		$sql = "SELECT posts.post_topic, posts.post_content, posts.post_date, posts.post_by, forum_users.user_id, forum_users.user_name FROM posts LEFT JOIN forum_users ON posts.post_by = forum_users.user_id WHERE posts.post_topic = " . $_GET['id'];
		
		$result = mysqli_query($dbc, $sql);
		
		if(!$result)
		{
			echo 'The posts could not be displayed. Please try again later.';
		}
		else
		{
			if((mysqli_num_rows($result)) == 0)
			{
				echo 'There are no posts in this topic yet';
								echo '<form class="reply" action="reply.php?id=' . $_GET['id'] . '" method="POST">
						<p>Make a Post: <textarea name="reply_content" rows="4" cols="50"></textarea></p>
						<input type="submit" value="Post">
						</form>';
			}
			else
			{
				echo '<table border="1">
						<tr>
							<th>Post</th>
							<th></th>
						</tr>';
						
				while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>
							<td class = "leftpart">' . $row['post_content'] . '</td>';
					echo '<td class="rightpart"> Posted on <b>' . $row['post_date'];
					echo '</b> by <b>' . $row['user_name'];
					echo '</b></td></tr>';
				}
				echo '<form class="reply" action="reply.php?id=' . $_GET['id'] . '" method="POST">
						<p>Reply: <textarea name="reply_content" rows="4" cols="50"></textarea></p>
						<input type="submit" value="Submit Reply">
						</form>';

			}
		}
	}
}
include 'footer.php';
?>