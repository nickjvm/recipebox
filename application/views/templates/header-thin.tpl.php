<!doctype HTML>
<html>
<head>
	<?php $this->load->view("templates/head.tpl.php"); ?>
</head>

<body class="navbar-thin">
	<nav class="navbar-left navbar-fixed-top">
		<a class="navbar-brand" href="/">RecipeBox</a>
		<div class="navbar-right thin-search">
			<form method="POST" action="/search" class="navbar-form">
				<?php $this->load->view("templates/search.tpl.php",$size); ?>
			</form>
		</div>
	</nav>
	<div class="container">	