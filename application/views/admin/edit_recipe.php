<?php $this->load->view("templates/header-thin.tpl.php",array("size"=>"small","terms"=>''));?>
<?php print form_open_multipart('recipes/save/'.$rid); ?>
<?php if (!is_null($title)) { ?>
<?php print form_hidden("title",$title);?>
<?php } else { 
	print "<label for='title'>Title</label>";
	print form_input("title",null,'class=form-control'); 
}?>
<?php //print $this->tank_auth->get_username(); ?>

<div class="row">
	<div class="col-sm-9 main-content">
		<div class="recipe-overview row">
			<div class="recipe-image col-sm-4">
			<?php if($image) { ?>
				<a href="<?php print recipe_image("full",$image); ?>">
					<img src="<?php print recipe_image("large",$image); ?>"/>
				</a>
			<?php } ?>
			<input type="file" name="userfile" class="form-control" size="1024" />

			</div>
			<div class="recipe-details col-sm-8">
				<h2><?php print $title; ?></h2>
				<ul class="nav nav-pills">
					<li><a href="/recipes/<?php print $alias; ?>">View</a></li>
					<li class="active"><a href="/recipes/edit/<?php print $rid; ?>">Edit</a></li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<h2>Ingredients</h2>
				<table class="sortable ingredients" data-bind="tableDnD:DataLoaded()">
				<?php 
				$j=0;
				?>
					<tbody data-bind="foreach:Ingredients">
						<tr data-bind="attr:{id:$index}" class='draggable'>
							<td class="force-small"><span class="move"></span></td>
							<td class="force-small"><?php print form_input("ingredient[quantity][]",null,"data-bind='value:quantity' class='short form-control'"); ?></td>
							<td><?php print form_dropdown("ingredient[measurement][]",measurements(),null,"data-bind='value:measurement' class='form-control'"); ?></td>
							<td><?php print form_input("ingredient[name][]",null,'data-bind="value:name" class="form-control"'); ?></td>
							<td class="force-small"><?php print form_input("ingredient[weight][]",null,'data-bind="value:weight" class="row-weight hidden"');?>
								<a class="remove-ingredient" href="#" data-bind="click:function() { $root.RemoveIngredient(id); }">&times;</a></td>
						</tr>
					</tbody>
				</table>
				<a data-bind="click:AddIngredient" href="#">+ add ingredient</a>
			</div>
			<div class="col-sm-12">
				<h2>Directions</h2>
				<table class="sortable directions" data-bind="tableDnD:DataLoaded()">
					<tbody data-bind="foreach:Directions">
						<tr data-bind="attr:{id:$index}" class='draggable'>
							<td class="force-small"><span class="move"></span></td>
							<td><?php print form_textarea("direction[text][]",null,'class="form-control" data-bind="value:text"');?></td>
							<td class="force-small"><?php print form_input("direction[weight][]",null,'data-bind="value:weight" class="row-weight hidden"'); ?>
								<a class="remove-direction" href="#" data-bind="click:function() { $root.RemoveDirection(id); }">&times;</a></td>
						</tr>
					</tbody>
				</table>
				<a data-bind="click:$root.AddDirection" href="#">+ add direction</a>

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
	</div>
	<div class="col-sm-3 sidebar">

	</div>
</div>

<?php print form_close(); ?>
<?php print $this->load->view("templates/footer.tpl.php"); ?>