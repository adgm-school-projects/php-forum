<?php

$server = 'server';
$username   = 'username';
$password   = 'password';
$database   = 'database';

$dbc = mysqli_connect('server','username','password');
mysqli_select_db($dbc, 'database');

if(!mysqli_connect($server, $username, $password, $database))
{
    exit('Error: could not establish database connection');
}
?>

