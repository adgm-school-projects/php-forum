<?php

include 'connect.php';
include 'header.php';

$sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id = " . $_GET['id'];

$result = mysqli_query($dbc, $sql);

if(!$result)
{
	echo 'The category could not be displayed. Please try again later.';
}
else
{
	if((mysqli_num_rows($result)) == 0)
	{
		echo 'This category does not exist';
	}
	else
	{
		/* Category heading */
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2>';
		}
		
		$sql = "SELECT topics_id, topic_subject, topic_date, topic_cat 
		FROM topics 
		WHERE topic_cat = " . $_GET['id'];
		
		$result = mysqli_query($dbc, $sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed. Please try again later.' . mysqli_error($dbc);
		}
		else
		{
			if((mysqli_num_rows($result)) == 0)
			{
				echo 'There are no topics in this caegory yet';
			}
			else
			{
				/* Topics Heading */
				echo '<table border="1">
						<tr>
							<th>Topic</th>
							<th>Created at</th>
						</tr>';
						
				while($row = mysqli_fetch_assoc($result))
				{
					echo '<tr>
							<td class = "leftpart">
							<h3><a href="topic.php?id=' . $row['topics_id'] . '">' . $row['topic_subject'] . '</a></h3></td>';
					echo '<td class="rightpart">';
					echo date('d-m-Y', strtotime($row['topic_date']));
					echo '</td></tr>';
				}
			}
		}
	}
}
include 'footer.php';
?>