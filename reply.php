<?php
session_start();
include 'core/connect.php';
include 'nav.php';
include 'Controllers/class.TopicController.inc';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	//echo 'This file cannot be called directly.';
	header("Location: index.php");
}
else
{
	//check for sign in status
	if(!$_SESSION['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		//a real user posted a real reply
		$sql = "INSERT INTO 
					posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES ('" . $_POST['reply-content'] . "',
						NOW(),
						" . mysql_real_escape_string($_GET['id']) . ",
						" . $_SESSION['user_id'] . ")";
						
		$result = mysql_query($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			$id = $_GET['id'];
			$o = new TopicController($id);
			$c = $o->getReplyCount() + 1;
			// now update reply
			//echo $c;
			$sql ="UPDATE topics SET reply_count='$c' WHERE topic_id = '$id'"; 
			// $sql = "UPDATE reply_count='$c' FROM topics WHERE topic_id = '$id'";
			mysql_query($sql);

			header("Location: topic.php?id=" . htmlentities($_GET['id']));
			echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
		}
	}
}

?>