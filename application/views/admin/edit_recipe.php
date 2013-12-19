<html>
<head>
	<title>Edit <?php print $title; ?></title>
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
	<div class="container">
		<?php print form_open_multipart('recipes/save/'.$rid); ?>
		<h1><?php print $title; ?></h1>
		<div class="row">
			<div class="col-sm-2">
				<img src="<?php print recipe_image("medium",$image); ?>"/>
				<input type="file" name="userfile" class="form-control" size="1024" />
			</div>
	<div class="col-sm-10">
<h2>Ingredients</h2>
<table class="sortable ingredients" data-bind="tableDnD:DataLoaded()">
<?php 
$j=0;?>
<tbody data-bind="foreach:Ingredients">
<tr data-bind="attr:{id:$index}" class='draggable'>
	<td><span class="move"></span></td>
	<td><?php print form_input("ingredient[quantity][]",null,"data-bind='value:Math.round((quantity * 100) / 100) || null' class='short form-control'"); ?></td>
	<td><?php print form_dropdown("ingredient[measurement][]",measurements(),null,"data-bind='value:measurement' class='form-control'"); ?></td>
	<td><?php print form_input("ingredient[name][]",null,'data-bind="value:name" class="form-control"'); ?></td>
	<td><?php print form_input("ingredient[weight][]",null,'data-bind="value:weight" class="row-weight hidden"');?>
		<a class="remove-ingredient" href="#" data-bind="click:function() { $root.RemoveIngredient(id); }">&times;</a></td>
</tr>
</tbody>
</table>
<a data-bind="click:AddIngredient" href="#">+ add ingredient</a>
</div>
</div>
<div class="row directions" >
	<div class="col-sm-12">
<h2>Directions</h2>
<table class="sortable directions" data-bind="tableDnD:DataLoaded()">
<tbody data-bind="foreach:Directions">
	<tr data-bind="attr:{id:$index}" class='draggable'>
		<td><span class="move"></span></td>
		<td><?php print form_textarea("direction[text][]",null,'class="form-control" data-bind="value:text"');?></td>
		<td><?php print form_hidden("direction[weight][]",null,'data-bind="value:weight"'); ?>
			<a class="remove-direction" href="#" data-bind="click:function() { $root.RemoveDirection(id); }">&times;</a></td>
	</tr>
</tbody>
</table>
<ul class="buttons">
	<li>
<?php
print form_button(array('name'=>'save','type'=>'submit','content'=>"Save Recipe","class"=>"btn btn-primary"));
 ?>
</li>
<li><a class="btn btn-link" href="/recipes/<?php print $alias; ?>">Cancel</a></li>
</ul>
</div>
</div>
<?php print form_close(); ?>
</div>
</body>
</html>