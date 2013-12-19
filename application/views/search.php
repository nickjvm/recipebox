<form method="POST">
	<input name="query" type="search"/>
	<input type="submit" value="search">
</form>

<?php if (!is_null($results)) { ?>
	<h1>Results for <?php print $terms; ?>:</h1>
	
<?php 
	foreach($results as $result) {
		print "<a href='".site_url(array("recipes",$result->alias))."'>".$result->title."</a>";
		print "<br/>";
	}
} else {
	if($terms) {
		print "<h1>No results for ".$terms."</h1>";
	}
 }
