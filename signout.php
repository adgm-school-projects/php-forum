<?php
include 'header.php';
include 'connect.php';
session_start();

session_destroy();

unset($_SESSION);

$_SESSION = array();

define('TITLE', 'Logout');
?>

<h2>You are now logged out.</h2>
<p><a href="signin.php">Back to Login Page</a></p>

<?php include('footer.php'); ?>