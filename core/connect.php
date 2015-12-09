<?php 
$server = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'thing';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not establish database connection');
}
if (!mysql_select_db($database)) {
	echo "can not connect to database";
}


 ?>