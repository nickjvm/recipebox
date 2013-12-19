<?php
class Recipes_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
        $this->load->helper('url');

	}

	//GET FUNCTIONS
	public function get_ingredients($slug = NULL) {
		if($slug != NULL) {
			if(!is_numeric($slug)) {
				$slug = $this->get_numeric_slug($slug);
			}
			$this->db->select("*")->from("ingredients")->where(array("rid"=>$slug))->order_by("weight","asc");
			
			$query = $this->db->get();

			return $query->result();
		}
	}

	public function get_directions($slug = NULL) {
		if($slug != NULL) {
			if(!is_numeric($slug)) {
				$slug = $this->get_numeric_slug($slug);
			}
			$this->db->select("*")->from("directions")->where(array("rid"=>$slug))->order_by("weight","asc");
			
			$query = $this->db->get();

			return $query->result();
		}
	}

	public function get_title($slug = NULL) {
		if($slug != NULL) {
			if(!is_numeric($slug)) {
				$slug = $this->get_numeric_slug($slug);
			}
			$this->db->select("title")->from("recipes")->where(array("rid"=>$slug));

			$query = $this->db->get();

			return $query->result()[0]->title;
		}
	}

	public function get_image($slug = NULL) {
		
		if($slug != NULL) {
			if(!is_numeric($slug)) {
				$slug = $this->get_numeric_slug($slug);
			}
			$this->db->select("filename")->from("images")->where(array("rid"=>$slug));

			$query = $this->db->get();
			return $query->result()[0]->filename;
		}
	}

	public function get_numeric_slug($slug) {
		if($slug != NULL) {
			$this->db->select("rid")->from("paths")->where(array("alias"=>$slug));

			$query = $this->db->get();
			if($query->num_rows() > 0) {
				return $query->result()[0]->rid;
			} else {
				show_404();
			}
		}
	}

	public function get_alias($slug = NULL) {
		if(is_numeric($slug)) {
			$this->db->select("alias")->from("paths")->where(array("rid"=>$slug));

			$query = $this->db->get();
			if($query->num_rows() > 0) {
				return $query->result()[0]->alias;
			} else {
				return $slug;
			}
		}
	}

	public function get_recipe($slug = NULL) {
		$data = NULL;
		if($slug != NULL) {
			$data['ingredients'] = $this->get_ingredients($slug);
			$data['directions'] = $this->get_directions($slug);
			$data['title'] = $this->get_title($slug);
			$data['image'] = $this->get_image($slug);
			if(!is_numeric($slug)) {
				$data['rid'] = $this->get_numeric_slug($slug);
				$data['alias'] = $slug;
			} else {
				$data['rid'] = $slug;
				$data['alias'] = $this->get_alias($slug);
			}
		}
		return $data;
	}
	//SAVE_FUNCTIONS

	public function save_ingredients($data = NULL,$slug = NULL) {
		if($slug != NULL) {
			$this->db->where("rid",$slug);
			$this->db->delete("ingredients");
		}
		
		for($i=0;$i<count($data['quantity']);$i++) {
			$ingredient = array(
				"quantity" => $data['quantity'][$i],
				"name" => $data['name'][$i],
				"measurement" =>$data['measurement'][$i],
				"weight" => $data['weight'][$i],
				"rid" => $slug
				);
			$this->db->insert("ingredients",$ingredient);
		}

	}

	public function save_directions($data = NULL,$slug = NULL) {
		if($slug != NULL) {

			$this->db->where("rid",$slug);
			$this->db->delete("directions");
		}
		
		for($i=0;$i<count($data['text']);$i++) {
			$direction = array(
				"text" => $data['text'][$i],
				"weight" => $data['weight'][$i],
				"rid" => $slug
				);
			$this->db->insert("directions",$direction);
		}
	}

	public function save_image($data = NULL,$slug = NULL) {
		if($slug != NULL) {
			$this->db->where("rid",$slug);
			$this->db->delete("images");
		}
		$file['uid'] = 1;
		$file['rid'] = $slug;
		$file['filename'] = $data['file_name'];
		$file['filemime'] = $data['file_type'];
		$this->db->insert("images",$file);
	}
	public function save_recipe($data = NULL,$slug = NULL) {
		if(!is_numeric($slug)) {
			$slug = $this->get_numeric_slug($slug);
		}
		if($data['image']) {
			$this->save_image($data['image'],$slug);
		}
		$data = $data['post'];
		$this->save_ingredients($data['ingredient'],$slug);
		$this->save_directions($data['direction'],$slug);
		//$this->save_image($data['image'],$slug);
		return true;
	}
  
}

