<?php

session_start();
include 'core/connect.php';
include 'nav.php';

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			topics
		WHERE
			topics.topic_id = " . mysql_real_escape_string($_GET['id']);
			
$result = mysql_query($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysql_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		/*
		// <!-- Newsfeed region -->
	// <div id=#timeline style="position:relative; left:15%; width:70%; color:black; background:darkgrey">
	
		// 
		// require("config.php");
		// //$sql = "SELECT date, subject, content FROM posts";
		
		// $sql = "SELECT u1.username, p1.date, p1.subject, p1.content FROM posts p1 LEFT JOIN users u1 ON p1.userid = u1.id";
		
		// $result = mysqli_query($conn, $sql);
		
		// while($row = mysqli_fetch_row($result))
		// {
			// $postTimestamp = $row[1];
			// $postSubject = $row[2];
			// $postContent = $row[3];
			// $postUsername = $row[0];
			
			// echo("<div id=#posting style=\"position:relative; border-bottom:1px solid; height:116px; width:100%\">
						
			// <div id=#subject style=\"position:absolute; top:1px; left:96px\">
			// $postSubject
			// </div>
			// <div id=#content style=\"word-wrap:break-word; position:absolute; left:96px; right:0px; top:20px; bottom:25px; padding:5px; padding-top:0px\">
			// $postContent
			// </div>
			// <div id=#username style=\"position:absolute; left:96px; bottom:5px\">
			// $postUsername
			// </div>
			// <div id=#timestamp style=\"position:absolute; right:10px; bottom:5px\">
			// $postTimestamp
			// </div>
		// </div>");
		// }
		
		// 
		
	// </div>
		*/
		
		
		while($row = mysql_fetch_assoc($result))
		{
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						posts.post_topic,
						posts.post_content,
						posts.post_date,
						posts.post_by,
						users.user_id,
						users.user_name
					FROM
						posts
					LEFT JOIN
						users
					ON
						posts.post_by = users.user_id
					WHERE
						posts.post_topic = " . mysql_real_escape_string($_GET['id']);
						
			$posts_result = mysql_query($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = mysql_fetch_assoc($posts_result))
				{
					echo '<tr class="topic-post">
							<td class="user-post">' . $posts_row['user_name'] . '<br/>' . date('d-m-Y H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content">' . htmlentities(stripslashes($posts_row['post_content'])) . '</td>
						  </tr>';
				}
			}
			
			if(!$_SESSION['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply:</h2><br />
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br /><br />
						<input type="submit" value="Submit reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

?>