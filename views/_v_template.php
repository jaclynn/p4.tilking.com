<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" href="/css/jquery.sidr.dark.css">
	<link rel="stylesheet" media="screen" href="/css/freewall.css" />
	<link rel="stylesheet" type="text/css" href="/css/pinterest-style.css" />
	<link rel="stylesheet" media="screen" rel="stylesheet" href="/css/p4.css" />				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	<script src="/js/jquery.min.js" type="text/javascript"></script>
	<script src="/js/jquery.freewall.js" type="text/javascript"></script>
    <script src="/js/jquery.sidr.min.js"></script>

	<script src="/js/p4.js" type="text/javascript"></script>
</head>

<body>	
<a id="simple-menu" href="#sidr">Toggle menu</a>
 
<div id="sidr">
  <!-- Your content -->
  <ul>
    <li><a href="/users/signup">Signup</a></li>
    <li><a href="/users/login">Login</a></li>
    <li><a href="/users/logout">Logout</a></li>
    <li><a href="/users/updateprofile">Update Profile</a></li>
  </ul>
</div>		
	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	

<footer>Copyright 2013 Jackie Wilson</footer>
</body>
</html>