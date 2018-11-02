<?php

$server = 'us-cdbr-iron-east-01.cleardb.net';
$username   = 'b28993a128cef3';
$password   = 'aab1e67d';
$database   = 'heroku_8b24e95e0b7a1d0';

$dbc = mysqli_connect('us-cdbr-iron-east-01.cleardb.net','b28993a128cef3','aab1e67d');
mysqli_select_db($dbc, 'heroku_8b24e95e0b7a1d0');

if(!mysqli_connect($server, $username, $password, $database))
{
    exit('Error: could not establish database connection');
}
?>

