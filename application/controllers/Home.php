<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('User_model');
		$this->load->model('Products_model');
		$this->load->library('encrypt');
		$this->load->library('pagination');

	}
	
	public function index()
	{
		if(!isset($_SESSION['sv_user_logged']) && $_SESSION['sv_user_logged'] != 1){
			redirect('login');
		}
		
		if($this->uri->segment(2)){
		 $page = ($this->uri->segment(2)) ;
		}
		else{
		 $page = 1;
		}
		if($page > 1)
		{
		 echo $start = ($page-1)*10;
		  echo $end = 10;
		}
		else
		{
		  echo $start = 10;
		  echo $end = 1;
		}
		$data['products'] = $this->Products_model->allProducts($start,$end);
		$total = $this->Products_model->allProductstotal();;
		 $total_row = count($total);
		//$this->load->view('home',$data);
		$config = array();
		$config["base_url"] = base_url()."home";
		$config["total_rows"] = $total_row;
		$config["per_page"] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = '<span class="next"> Next </span>';
		$config['prev_link'] = 'Previous';
		$this->pagination->initialize($config);
		//$this->pagination->create_links();
		$this->load->view('bidlisting',$data);
		
	}
}
