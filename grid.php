<?php
/*
	@! Dynamic grid layout using jQuery
-----------------------------------------------------------------------------	
	# author: @akshitsethi
	# web: http://www.akshitsethi.me
	# email: ping@akshitsethi.me
	# mobile: (91)9871084893
-----------------------------------------------------------------------------
	@@ The biggest failure is failing to try.
*/
?>
<!doctype html>
<html lang="en">
<head>
<title>Dynamic grid layout using jQuery - A tutorial by akshitsethi.me</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="Description" content="Learn to create Pinterest like dynamic grid layout using jQuery." />
<meta name="Keywords" content="grid layout, pinterest, layout, dynamic layout, jquery, akshitsethi" />
<meta name="Owner" content="Akshit Sethi" />
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.freewall.js"></script>
</head>
<body>
	<div class="header">
		<div class="header-inner clearfix">
			<div class="pull-left">
				<a href="http://www.akshitsethi.me" target="_blank"><img src="img/logo.png" class="logo"></a>
			</div>

			<div class="pull-right">
				<p class="small-text no-margin no-padding"><span class="highlight">Dynamic <strong>grid layout</strong> using jQuery</span></p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="page-header">
			<h1>Dynamic grid layout using jQuery</h1>
			<p class="no-padding">In this <strong><a href="http://www.akshitsethi.me/pinterest-like-grid-layout-using-jquery" target="_blank">Tutorial</a></strong>, learn to create Pinterest like grid layout using jQuery. The layout which adjusts itself according to the screen width. Try resizing your browser to see elements changing place in order to adapt to the screen size.</p>
		</div>

		<div class="content">
			<div class="size21 light-background border">
				<p class="align-center strong">DIV 1</p>
			</div>

			<div class="size22 border">
				<p class="align-center strong">Headlines</p>
			</div>

			<div class="size2 light-background border">
				<p class="align-center strong">AD Block</p>
			</div>

			<div class="size2 light-background border">
				<p class="align-center strong">AD Block</p>
			</div>

			<div class="size31 border">
				<p class="align-center">I am small or <strong>BIG</strong>?</p>
			</div>

			<div class="size23 border">
				<p class="align-center strong">Just another DIV</p>
			</div>

			<div class="size12 border">
				<p class="align-center">This DIV has got text that is not <strong>bold</strong>.</p>
			</div>

			<div class="size13 border">
				<p class="align-center">What's this? Just ignore me <strong>;)</strong></p>
			</div>

			<div class="size24 light-background border">
				<p class="align-center strong">I am Huge</p>
			</div>

			<div class="size32 border">
				<p class="align-center strong">DIV Block</p>
			</div>

			<div class="size33 border">
				<p class="align-center strong">DIV Block</p>
			</div>
		</div>

		<script type="text/javascript">
			$(function() {
				var wall = new freewall(".content");

				wall.reset({
					selector: '.border',
					animate: true,
					onResize: function() {
						this.fitWidth();
					}
				});

				wall.fitWidth();
			});
		</script>

		<div class="page-footer">
			<p class="no-padding">A small piece of code by <strong><a href="http://www.akshitsethi.me" target="_blank">Akshit Sethi</a></strong></p>
		</div>
	</div>
</body>
</html>