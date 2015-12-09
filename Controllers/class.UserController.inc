<?php 

/**
* This is a UserController class that handles the behaviours of users
* Created by group 16
* UOIT 
* WEB PROGRAMING CLASS FINAL ASSIGNMENT
*/
class UserController
{
	private $name;

	//constructor
	public function UserController ($n) {

		$this->name = $n;
	}


	// This method checks if a user is admin

	public function isAdmin(){
		require('core/connect.php');


		$sql ="SELECT user_level FROM users WHERE user_name = '$this->name'"; 
		$result = mysqli_query(mysqli_connect('localhost','root','', $database), $sql);
		$row = mysqli_fetch_row($result);

		$admin = $row[0];

		return $admin;
	}

	// setter method that makes an user admin
	public function makeAdmin($id){
		require('core/connect.php');
		$sql ="UPDATE users SET user_level='1' WHERE user_id = '$id'"; 
		$result = mysqli_query(mysqli_connect('localhost','root','', $database), $sql);

		

	}

	//setter method changes the user password
	public function changePass($oP, $nP, $u){
		require 'core/connect.php';
		$ooP = sha1($oP);
		$nnP = sha1($nP);
		$sql ="UPDATE users SET user_pass='$nnP' WHERE user_name = '$u' AND user_pass='$ooP'"; 
		$result = mysqli_query(mysqli_connect('localhost','root','', $database), $sql);
		if ($result) {
			echo "Successfully changed password";
		}

	}


}

 ?>