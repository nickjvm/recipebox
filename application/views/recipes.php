<?php $this->load->view("templates/header-thin.tpl.php",array("size"=>"small","terms"=>''));?>

<div class="row">

<div class="col-sm-9 main-content">

	<div class="row">
		<div class="recipe-overview">
			<div class="recipe-image col-sm-4">
				<a href="<?php print recipe_image("full",$image); ?>">
					<img src="<?php print recipe_image("large",$image); ?>"/>
				</a>
			</div>
			<div class="recipe-details col-sm-8">
				<h2><?php print $title; ?></h2>
				<ul class="nav nav-pills">
					<li class="active"><a href="/recipes/<?php print $alias; ?>">View</a></li>
					<li><a href="/recipes/edit/<?php print $rid; ?>">Edit</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			
			<h2>Ingredients</h2>
				<ul class="list-group">
					<?php foreach($ingredients as $ingredient) { ?>
						<li class="list-group-item">
							<?php 
							print "<span class='amount'>";
							print $ingredient->quantity;
							print " ";
							print $ingredient->measurement;
							print "</span>";
							print " ";
							print $ingredient->name; ?>
						</li>
					<?php } ?>
				</ul>
			</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<h2>Directions</h2>
		<ol>
			<?php foreach($directions as $direction) {?>
				<li><?php print $direction->text; ?></li>
			<?php } ?>
		</ol>
		</div>
	</div>
</div>
<div class="col-sm-3 sidebar-right">
	<?php $this->load->view("templates/sidebar.tpl.php"); ?>
</div>




<?php $this->load->view("templates/footer.tpl.php"); ?>