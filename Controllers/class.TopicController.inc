<?php 
/**This class has the behaviour of Topics
*  Created by group 16 
*  UOIT WEB PROGRAMING FINAL ASSIGNMENT
*/
class TopicController
{
	private $tid;
	
	public function TopicController($id){
		$this->tid = $id;
	}

	//This function gets the name of the user that created the topic_cat
	public function getCreator(){
		include 'core/connect.php';
		// search for the user id
		$sql = "SELECT topic_by FROM topics WHERE topic_id = '$this->tid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
		$uid = $row['topic_by'];
		// $sql = "SELECT users.user_name
				// FROM users
				// INNER JOIN topics
				// WHERE topic_cat = ". $this->cid;

		########## find the user with that id ##########
		$sql2 = "SELECT user_name FROM users WHERE user_id = '$uid'";
		$result2 = mysql_query($sql2);
		$row2 = mysql_fetch_assoc($result2);

		return $row2['user_name'];
	}
	
	public function getReplyCount()
	{
		// this method gets the reply count
		$sql = "SELECT reply_count FROM topics WHERE topic_id = '$this->tid'";
		$result = mysql_query($sql);
		//var_dump($result);
		$row = mysql_fetch_assoc($result);
		$u = $row['reply_count'];
		
		return $u;
	}
	//This function gets the time of the last post in the category
	public function getLastUpdate()
	{
		include 'core/connect.php';
		$sql = "SELECT post_date FROM posts WHERE post_topic = $this->tid ORDER BY post_date DESC LIMIT 1";
		$result = mysql_query($sql);
		//var_dump($result);
		$row = mysql_fetch_assoc($result);
		//var_dump($row);
		$date = $row['post_date'];
		return $date;
	}
	
}
?>