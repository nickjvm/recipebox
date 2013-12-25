<?php if ($title): ?>
	<title><?php print $title; ?></title>
<?php else: ?>
	<title>RecipeBox</title>
<?php endif; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php print assetURL(); ?>js/vendor/jquery-1.10.1.min"><\/script>')</script>
<?php js(array("vendor/modernizr.min","knockout-3.0.0","jquery.cookie","jquery.tablednd","recipes")); ?>

<?php css(array("main")); ?>

<script>
	var rid = <?php print $rid; ?>;
</script>