<?php
	$size = ($size) ? $size : "small";
	$autofocus = isset($autofocus) ? $autofocus : false;
?><div id="search-container" >
	<form method="POST" class="form-inline">
		<div class="input-group">
			<input name="query" type="search" <?php if($autofocus) { print "autofocus"; } ?> placeholder="Browse for a recipe" value="<?php print ($terms) ? $terms: ''; ?>" class="<?php print ($size == 'large') ? 'input-lg' : ''; ?> form-control"/>
			<span class="input-group-btn">
				<input type="submit" value="get cookin'" class="btn btn-primary <?php print ($size == 'large') ? 'btn-lg' : ''; ?>">
			</span>
		</div>
	</form>
</div>