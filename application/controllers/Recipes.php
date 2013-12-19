<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('recipes_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('image_lib');

	}
	public $i=0;
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function view($slug) {
		$data = $this->recipes_model->get_recipe($slug);
		$this->load->view('recipes', $data);
	}

	public function edit($slug) {
		$data = $this->recipes_model->get_recipe($slug);
		$this->load->view("admin/edit_recipe",$data);
	}
	public function do_upload() {
			$config['upload_path'] ="./assets/img/recipes";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max-size'] = 1024;
			$config['max-width'] = 500;
			$config['max-height'] = 500;

			$this->load->library('upload', $config);
			if(!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				die();
			} else {
				$file = $this->upload->data();
				//create different sizes

				$this->square($file['full_path'],$file['file_name'],"thumb");
				$this->square($file['full_path'],$file['file_name'],"small");
				$this->square($file['full_path'],$file['file_name'],"medium");
				$this->square($file['full_path'],$file['file_name'],"large");
				return $this->upload->data();
			}
			
	}
	
	private function scale($source,$filename,$width,$height) {
			print_r($size);
			//die();
			print $width;
			//die();
		$new_source = "./assets/img/recipes/medium/".$filename;
		$config['source_image']	= $source;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['quality'] = 100;
		//$config['height'] = ($size[1] > $size[0]) ? $size[1] : '';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		if ( ! $this->image_lib->resize())
		{
		    echo $this->image_lib->display_errors();
		}
	}
	private function square($source,$filename,$size) {

		switch ($size) {
			case "thumb":
				$width = 50;
				$height = 50;
				break;
			case "small":
				$width = 100;
				$height = 100;
				break;
			case "medium":
				$width = 200;
				$height = 200;
				break;
			case "large":
				$width = 400;
				$height = 400;
				break;
			default:
				return false;
				break;
		}
		$new_source = "./assets/img/recipes/".$size."/".$filename;
		$config['source_image']	= $source;
		$config['new_image'] = $new_source;
		$config['maintain_ratio'] = FALSE;
		$config['width']	 = $width;
		$config['height']	= $height;
		$config['quality'] = 100;

		$this->image_lib->initialize($config); 
		if ( ! $this->image_lib->fit())	{
		    echo $this->image_lib->display_errors();
		} else {
			//$this->scale($new_source,$filename,$width,$height);
		}
	}
	public function save($slug) {
		if(($_FILES && $_FILES['userfile']['name'])) {
			$file = $this->do_upload();
		}
		$data['post'] = $this->input->post();
		$data['image'] = $file;

		if($this->input->post()) {
			$save = $this->recipes_model->save_recipe($data,$slug);
		}
		if($save) {
			redirect("/recipes/".$slug);
		}
	}

	public function get() {
		$rid = $this->input->post("rid");
		
		if($rid != NULL) {
			print json_encode($this->recipes_model->get_recipe($rid));
		} 
	}
}