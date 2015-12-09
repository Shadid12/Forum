<head>
	<!-- Reference Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/feed.css"> 
</head>
<!-- Background colour:#DADADA -->

<?php 
session_start();
include('nav.php'); // calling the navbar
include('core/connect.php');

if (isset($_SESSION['signed_in']) && $_SESSION['signed_in']) {
	include('newPost.php');
}
// feed this file shows all the active category threads

$sql = "SELECT * FROM categories";
 
$result = mysql_query($sql);

if(mysql_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
             
        while($row = mysql_fetch_assoc($result))
        {               
           // echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description']; 


        	echo '<ul id="people">';
        	echo '<li>';
			if ($row['img'] != '')
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['img'] ).'"/>';
        	echo '<span>';
        	echo '<h2><a href="catView.php?id='.$row['cat_id'].'">'.$row['cat_name'].'</h2>';
        	echo '<span class="info">';
        	echo '<em>'. $row['cat_description']. '</em>';
        	echo '</span>';
        	echo '</li>';
        	echo '</ul>';
        }
    }
 ?>