


<?php 
require 'Controllers/class.UserController.inc';
include 'core/connect.php';
include 'nav.php';


if (isset($_POST['reset']) && isset($_POST['email'])) {
	$e = $_POST['email'];
	// $nnP = sha1('123456');
	// $sql ="UPDATE users SET user_pass='$nnP' WHERE user_email = '$e'"; 
	// $result = mysqli_query(mysqli_connect('localhost','root','', $database), $sql);

	$sql ="SELECT user_name FROM users WHERE user_email = '$e'"; 
	$result = mysqli_query(mysqli_connect('localhost','root','', $database), $sql);
	$row = mysqli_fetch_row($result);

	if ($row == false) {
		echo "No users with this email exist";
	}
	else{
		
		// Generate a new password and update in the database
		$newPass = rand(1000,99999);
		$nnP = sha1($newPass);
		$sql2 ="UPDATE users SET user_pass='$nnP' WHERE user_email = '$e'"; 
		$result = mysqli_query(mysqli_connect('localhost','root','', $database), $sql2);

		// Give user password and email for reference
		$msg = "Your new temporary password is $newPass. We recommend changing this as soon as possible";

		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		
		echo $msg;
		// send email
		mail($e,"password reset",$msg);
	}
}
else{
	$out = htmlspecialchars($_SERVER["PHP_SELF"]);
	echo ("<h1>Reset Password</h1>
<form action=\"$out\" method= \"post\" enctype=\"multipart/form-data\">
		<p> email address:
			<input type = \"text\" name=\"email\"></input>
			<br>
		</p>
		<p>	<input type = \"submit\" value=\"Reset\" name=\"reset\"></input>
		</p>			
</form>");
}




 ?>
 
 