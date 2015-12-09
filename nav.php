<head>
	<!-- Reference Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/post.css">
	<style>
	body{
		background-color:#DADADA;
	}
	 </style>
</head>

<!-- Strat navigatioin bar -->
<nav id="site-navigation" class="main-navigation" role="navigation">
  <div class="nav-menu">
    <ul>
      <li class="current_page_item"><a href="index.php" title="Home">Home</a></li>
      

      <?php 
        // check if a user is already sisgnned in 
        if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'])
		{
			// echo 'Hello <b>' . htmlentities($_SESSION['user_name']);
			echo '<li class="page_item page-item-7"><a href="account.php">Account</a></li>';
			echo '<li class="page_item page-item-7"><a href="thread.php">Make a Post</a></li>';
			echo '<li class="page_item page-item-7"><a href="signout.php">Log out</a></li>';
						
		}
		else{
			echo '<li class="page_item page-item-7"><a href="signin.php" title="Home">Log In</a></li>';
			echo '<li class="page_item page-item-7"><a href="signup.php" title="Home">Register</a></li>';
		}
       ?>
      <li class="current_page_item"><a href="rss.xml" title="RSS FEED">RSS Feed</a></li>
    </ul>
  </div><!-- .nav-menu -->
</nav><!-- #site-navigation -->
