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
			$this->db->join("paths","recipes.rid = paths.rid");
			$query = $this->db->get('recipes');
			return $query->result();
		}
		return NULL;
	}

  
}

