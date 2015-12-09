
<?php 
session_start();
require 'Controllers/class.UserController.inc';
include 'nav.php';
$name = $_SESSION['user_name'];

if (isset($_POST['updatePass'])) {
	$newP = $_POST['newP'];
	$oldP = $_POST['oldP'];
	
	$obj = new UserController($name);
	$obj->changePass($oldP, $newP, $name);
} else {
	echo ("
<form method= \"post\" enctype=\"multipart/form-data\">
		<p> Old	Password:
			<input type = \"password\" name=\"oldP\"></input>
			<br>
		</p>
		<p> New	Password:
			<input type = \"password\" name=\"newP\"></input>
			<br>
		</p>
		<p>	<input type = \"submit\" value=\"Change\" name=\"updatePass\"></input>
		</p>			
</form>");

}

 ?>