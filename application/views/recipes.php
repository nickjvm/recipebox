<html>
<head>
	<title>Recipes!11!!</title>
	<script type='text/javascript' src='//code.jquery.com/jquery-1.10.2.min.js'></script>
	<script type='text/javascript' src='<?php print assetURL(); ?>js/knockout-3.0.0.js'></script>
	<script type='text/javascript' src='<?php print assetURL(); ?>js/jquery.cookie.js'></script>
	<script type='text/javascript' src='<?php print assetURL(); ?>js/jquery.tablednd.js'></script>

	<script type='text/javascript' src='<?php print assetURL(); ?>js/recipes.js'></script>
	<link rel="stylesheet" href="<?php print assetURL(); ?>css/main.css" type="text/css"/>
	<script>
	var rid = <?php print $rid; ?>;

	</script>
</head>
<body>
<h1><?php print $title; ?></h1>
<a href="<?php print recipe_image("full",$image); ?>"><img src="<?php print recipe_image("medium",$image); ?>"/></a>
<ul>
<?php 
foreach($ingredients as $ingredient): ?>
<li><?php 
print round($ingredient->quantity,3);
print " ";
print $ingredient->measurement;
print " ";
print $ingredient->name; ?>
<?php endforeach; ?>
</ul>
	<ol>
<?php 
foreach($directions as $direction): ?>
<li><?php 

print $direction->text;
 ?>
<?php endforeach; ?>
<ol>
<ul class="buttons">
	<li><a href="/recipes/edit/<?php print $rid; ?>">Edit</a></li>
</ul>
</body>
</html>