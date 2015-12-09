<?php
//category.php
session_start();
include 'core/connect.php';
include 'nav.php';
require('Controllers/class.CatController.inc');
require('Controllers/class.TopicController.inc');
//first select the category based on $_GET['cat_id']
$id = mysql_real_escape_string($_GET['id']);

$obj = new CatController($id);  // create new object of CatController class
$result = $obj->getTopics();

$name = $obj->getName();
//echo $name;

//Label bar
echo ("<div id=\"catContainer\">
	<p>$name</p>
	<div class=\"topic\" id=\"titlebar\">
		<div id=\"name\">Title</div>
		<div id=\"created-by\">Created by</div>
		<div id=\"reply-count\">Replies</div>
		<div id=\"last-update\">Last Update</div>
	</div>\n\t");
//Need to echo the create box
if(mysql_num_rows($result) == 0)
{
	//Echo an empty thing instead?
	echo '<br>There are no topics in this category yet.';
}
else
{
	/*
	//prepare the table
	echo '<table border="1">
		  <tr>
			<th>Topic</th>
			<th>Created at</th>
		  </tr>';	
		
	while($row = mysql_fetch_assoc($result))
	{				
		echo '<tr>';
			echo '<td class="leftpart">';
				echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
			echo '</td>';
			echo '<td class="rightpart">';
				echo date('d-m-Y', strtotime($row['topic_date']));
			echo '</td>';
		echo '</tr>';
	}
	*/
	while($row = mysql_fetch_assoc($result))
	{
		$id = $row['topic_id'];
		$tpic = new TopicController($id);
		
		
		$title = "<a href=\"topic.php?id=" . $id . "\">" . $row['topic_subject'] . "</a>";
		$creator = $tpic->getCreator();
		$replyCount = $tpic->getReplyCount();
		$lastUpdate = $tpic->getLastUpdate();
		// List of topics
	echo ("<div class=\"topic\" id=\"usertopic\">
		<div id=\"name\">$title</div>
		<div id=\"created-by\">$creator</div>
		<div id=\"reply-count\">$replyCount</div>
		<div id=\"last-update\">$lastUpdate</div>
	</div>");
	}
}
echo ("<br><a href='thread.php?topic=$id'>Create post</a><br>");
//Close the category container
echo ("\n</div>");
?>