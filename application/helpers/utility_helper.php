<?php 

function imageURL($filename) {
	return base_url()."assets/img/".$filename;
}

function assetURL() {
	return base_url()."assets/";
}

function recipe_image($size,$filename) {
	switch ($size) {
		case "thumb":
			return assetURL()."img/recipes/thumb/".$filename;
		case "small":
			return assetURL()."img/recipes/thumb/".$filename;
		case "medium":
			return assetURL()."img/recipes/medium/".$filename;
		case "large":
			return assetURL()."img/recipes/large/".$filename;
		default:
			return assetURL()."img/recipes/".$filename;
	}
}

setlocale(LC_ALL, 'en_US.UTF8');


function clean($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

function unique_slug($title) {

	$slug = clean($title);
	$i = 0;
	while(slug_exists($slug)) {
    	$slug = clean($title.'-'.$i++);
    }
    return $slug;
}

function slug_exists($slug) {
	$ci =& get_instance();
	$query = $ci->db->get_where("paths",array("alias"=>$slug));
		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
}

function measurements() {
	return array(
		"cup" => "Cup",
		"tsp" => "Teaspoon",
		"tbsp" => "Tablesppon",
		"pinch" => "Pinch",
		"oz"=>"Ounce");
}