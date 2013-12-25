<div class="group">
	<h3>You may also like...</h3>
	<ul class="list-unstyled recent">
	<?php 

	$data = $this->search_model->get_latest(5,$rid);
		

		foreach($data as $recipe) {
			print "<li class='thumbnail recipe-thumbnail'><a href='".site_url("/recipes/".$recipe->alias)."'>";
			print "<img src='".recipe_image("medium",$recipe->filename)."'/>";
			print "<span class='recipe-title'>".$recipe->title."</span>";
			print "</a></li>";
		}

		?>

	</ul>
</div>