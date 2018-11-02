<?php
include 'connect.php';
include 'header.php';

$sql = "SELECT categories.cat_id, categories.cat_name, categories.cat_description, topics.topics_id, topics.topic_subject, topics.topic_date, topics.topic_cat FROM topics RIGHT JOIN categories ON topics.topic_cat = categories.cat_id";

$result = mysqli_query($dbc, $sql);

if(!result)
{
	echo 'The categories could not be displayed. Please try again later';
}
else
{
	if((mysqli_num_rows($result)) == 0)
	{
		echo 'No Categories have been defined yet.';
	}
	else
	{
		echo '<table border="1">
				<tr>
					<th>Category</th>
					<th>Last topic</th>
				</tr>';
		while($row = mysqli_fetch_assoc($result))
		{
			echo '<tr>
			<td class="leftpart">
				<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'] . '</td>';
			echo '<td class="rightpart"><a href="topic.php?id=' . $row['topics_id'] . '">'. $row['topic_subject'] . '</a> at  ' . $row['topic_date'] . '</td></tr>';                      
		}
	}
}
include 'footer.php';
?>