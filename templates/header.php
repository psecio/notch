<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/css/site.css" rel="stylesheet">
		<script type="text/javascript" src="/assets/js/jquery-1.11.1.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	      	<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Notch</a>
					</div>
					<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
					<li class="active"><a href="/">Home</a></li>

					<?php if (isset($_SESSION['username'])): ?>
						<li class="active"><a href="/user/logout">Logout</a></li>
						<li class="active"><a href="/post/add">Add Post</a></li>
					<?php else: ?>
						<li class="active"><a href="/user/login">Login</a></li>
					<?php endif; ?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		<div class="container" style="padding-top:70px">
			<?php if (isset($_SESSION['username'])): ?>
				<div>Logged in as <b><?php echo $_SESSION['username']; ?></b> (<a href="/user/logout">logout</a>)</div>
			<?php endif; ?>