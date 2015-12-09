<?php 
session_start();
include 'nav.php';
require('Controllers/class.UserController.inc');

// double check the user admin privilage
$u = new UserController($_SESSION['user_name']);

if ($u->isAdmin() && $_SESSION['signed_in']== true) {

	if($_SERVER['REQUEST_METHOD'] != 'POST' )
	{
		//the form hasn't been posted yet, display it
		echo '<form method="post" action="" enctype="multipart/form-data">
			Category name: <input type="text" name="cat_name" /><br />
			Category description:<br /> <textarea name="cat_description" /></textarea><br /><br />
			<input type = "file" value="Browse" name="file"></input><br />
			<input type="submit" value="Add category" />
		     </form>';
	}
	else
	{
		//the form has been posted, so save it

		$file=($_FILES['file']['tmp_name']);		// gives location
		$data = file_get_contents($_FILES['file']['tmp_name']);


		///////////////////
		$sql = "INSERT INTO categories(cat_name, cat_description, img)
		   VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
				 '" . mysql_real_escape_string($_POST['cat_description']) . "',
				 '" . addslashes($data) . "')";
		$result = mysql_query($sql);
		if(!$result)
		{
			//something went wrong, display the error
			echo 'Error' . mysql_error();
		}
		else
		{
			echo 'New category succesfully added.';
		}
	}
	
}


 ?>


