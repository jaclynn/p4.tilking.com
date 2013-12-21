<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">	
	<link rel="stylesheet" href="/css/jquery.sidr.dark.css">
	<link rel="stylesheet" type="text/css" href="/css/freewall.css" />
	<link rel="stylesheet" type="text/css" href="/css/pinterest-style.css" />
				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>

</head>

<body>
<a id="simple-menu" href="#sidr" class="myButton">codecanyon</a>

<div id="sidr">
        <ul>
        	<li><a href="/index/index"><img src="/img/See-LUV-Get_truck.png" id="logo" alt="logo"/></a></li>
		    <li><a href="/users/signup">Signup</a></li>
		    <li><a href="/users/login">Login</a></li>
		    <li><a href="/users/logout">Logout</a></li>
		    <li><a href="/users/updateprofile">My Profile</a></li>
		    <li><a href="/bricks/index">Show All Bricks</a>
		    	<ul>
		    		<li><a href="/bricks/index/AVAILABLE">Show Available</a></li>
		    		<li><a href="/bricks/index/PPU">Show Pending</a></li>
		    		<li><a href="/bricks/index/SOLD">Show Sold</a></li>
		    		<li><a href="/bricks/index/<?=$user->user_id?>">Show My Bricks</a></li>
		    	</ul>
		    </li>
		    <li><a href="/bricks/add">Add Brick</a></li>
        </ul>
</div>

<!--
<a id="simple-menu" href="#sidr">Toggle menu</a>
 
<div id="sidr">
  
  <ul>
  </ul>
</div>-->		
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<!-- <script src="/js/jquery.min.js" type="text/javascript"></script> -->
	<script src="/js/jquery.sidr.min.js"></script>
	<script src="/js/jquery.freewall.js" type="text/javascript"></script>
	
	<link rel="stylesheet" media="screen" href="/css/p4.css" />	
	<script src="/js/p4.js" type="text/javascript"></script>
</body>
</html>