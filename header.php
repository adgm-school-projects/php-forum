<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
 <!---------------------------------------------------------------
 - Created by Adam Morelli 
 - for Building Database Driven Websites
 - with help from
 - "How to Create a PHP/MySQL Powered Forum from Scratch" 
 - by Evert Padje
 - http://code.tutsplus.com/tutorials/how-to-create-a-phpmysql-powered-forum-from-scratch--net-10188
	---------------------------------------------------------------->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>DDW Final Project</title>
	<link rel="stylesheet" href="styles/style.css" type="text/css">
</head>
<body>
<h1><a href="index.php">Adam's PHP-Powered Forum!</a></h1>
    <div id="wrapper">
    <nav>
        <a class="item" href="index.php">Home</a>
        <a class="item" href="create_topic.php">Create a topic</a>
        <a class="item" href="create_cat.php">Create a category</a>
         
		
<?php
echo '<div id="userbar">';
    if($_SESSION['signed_in'])
    {
        echo 'Hello, <b>' . $_SESSION['user_name'] . '.</b> Not you? <a href="signout.php">Sign out</a>';
    }
    else
    {
        echo '<a href="signin.php">Sign in</a> or <a href="signup.php">create an account</a>.';
    }
echo '</div>';
?>

    </nav>
        <div id="content">