<?php 
require('Controllers/class.UserController.inc');
echo 'Hello <b>' . htmlentities($_SESSION['user_name']);

$u = new UserController($_SESSION['user_name']);

// check if the user is admin
// Only admins can create new Categories
echo "<p>";
if ($u->isAdmin() && $_SESSION['signed_in']== true) {
	echo '<br><a href="cat.php">Make New Category</a>';
}
echo "<br><a href='thread.php'>Make New Thread</a></p>";
 ?>

