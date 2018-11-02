<?php
include 'header.php';
include 'connect.php';

/* Check if the post request has been made. If not, display form. */
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo '<form action="create_cat.php" method="POST">
        <p>Category name: <input type="text" name="cat_name"></p>
        <p>Category description: <textarea name="cat_description"></textarea></p>
        <input type="submit" value="Add category">
     </form>';
}
else // Insert category name and description into table
{
	$cat_name = trim(strip_tags($_POST['cat_name']));
	$cat_desc = trim(strip_tags($_POST['cat_description']));
	
    $sql = "INSERT INTO categories(cat_name, cat_description)
			VALUES('$cat_name','$cat_desc')";
			
    $result = mysqli_query($dbc, $sql);
    if(!$result)
    {
        echo 'Error' . mysqli_error();
    }
    else
    {
        echo 'New category successfully added.';
    }
}
include 'footer.php';
?>