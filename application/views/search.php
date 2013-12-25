<?php $data = array(
	"title"=>"Find a Recipe",
	"autofocus"=>true); ?>
<?php if ($terms) { 
	$this->load->view("templates/header-thin.tpl.php",array("size"=>"small","terms"=>$terms,"title"=>"Find a Recipe")); 
} else {
	$this->load->view("templates/header.tpl.php",$data);
}?>
<?php if(!$terms) { ?>
	<div class="hero">
		<div class="row">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<?php $this->load->view("templates/search.tpl.php",array("terms"=>$terms,"size"=>"large")); ?>
			</div>
			<div class="col-sm-3"></div>
		</div>
		<div class="row latest">
			<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<h2>Latest Recipes</h2>
				<ul class="recipes-thumb-list">
					<?php foreach($latest as $recipe) { ?>
						<li>
							<?php 
								print "<a href='".site_url(array("recipes",$recipe->alias))."'>";
								print "<img src='".recipe_image("medium",$recipe->filename)."'/>";
								print $recipe->title;
								print "</a>";

							?>
						</li>
					<?php }?>
				</ul>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</div>
<?php } ?>

<?php if (count($results) && $terms) { 
	print "<h1>Results for ".$terms.":</h1>";

	foreach($results as $result) {
		print "<a href='".site_url(array("recipes",$result->alias))."'>".$result->title."</a>";
		print "<br/>";
	}
} else {
	if($terms) {
		print "<h1>No results for ".$terms."</h1>";
	}
 }
 
$this->load->view("templates/footer.tpl.php"); ?>