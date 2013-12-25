<?php
class Search_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
        $this->load->helper('url');

	}

	public function get_results($query = NULL) {
		if($query != NULL) {
			$terms = explode(" ",$query);
			foreach($terms as $term) {
				$this->db->or_like('title',$term);
			}
		}
		$this->db->join("paths","recipes.rid = paths.rid");
		$this->db->order_by("edited","desc");
		$this->db->order_by("created","desc");
		$query = $this->db->get('recipes');
		return $query->result();
		 
	}

	public function get_latest($limit = 3,$exclude = NULL) {
		$this->db->join("images","recipes.rid = images.rid");
		$this->db->join("paths","recipes.rid = paths.rid");
		if($exclude) {
			$this->db->where("recipes.rid !=",$exclude);
		}
		$this->db->order_by("created","desc");
		$query = $this->db->get("recipes", $limit,0);

		return $query->result();

	}

  
}

