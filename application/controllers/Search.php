<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model('search_model');
		/*$this->load->model('recipes_model');
        $this->load->helper('url');
        $this->load->helper('form');*/

	}
	public function index($search = NULL)
	{
		
		$data['terms'] = NULL;
		if($this->input->post()) {
			redirect("search/".$this->input->post("query"));
			$data['terms'] = $this->input->post("query");
		} else {
			$data['terms'] = urldecode($search);
		}
		$data['results'] = $this->search_model->get_results($data['terms']);
		if(count($data['results']) == 1) {
			redirect("recipes/".$data['results'][0]->alias);
		}
		$data['latest'] = $this->search_model->get_latest();
		$this->load->view("search",$data);
		
	}

}