<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
		$this->load->model('Reports_model');
		$this->load->library('encrypt');

	}

	public function index(){
		redirect('admin/reports/winnings');
	}

	public function winnings()
	{
		$start = date('Y-m-d H:i:s',strtotime('yesterday'));
		$end = date('Y-m-d H:i:s',strtotime('now'));
		$data['winnings'] = $this->Reports_model->getAllWinnings($start,$end);
		$this->load->view('admin/reports/winnings',$data);
	}

	public function winnings_ajax(){
//		print_r($_POST);
		$start = date('Y-m-d H:i:s',strtotime($_POST['start']));
		$end = date('Y-m-d H:i:s',strtotime($_POST['end'].'+ 23 hours 59 minutes 59 seconds'));
		$data['winnings'] = $this->Reports_model->getAllWinnings($start,$end);
		echo $this->load->view('admin/reports/winnings_ajax',$data,true);
	}

	public function in_yard()
	{

		$data['in_yard'] = $this->Reports_model->getAllInYard(1);
		$this->load->view('admin/reports/in_yard',$data);
	}

	public function in_yard_ajax(){
		$data['in_yard'] = $this->Reports_model->getAllInYard($_POST['id']);
		echo $this->load->view('admin/reports/in_yard_ajax',$data,true);
	}

	public function document_transfer()
	{
		$this->load->view('admin/reports/document_transfer');
	}

	public function product_biddings()
	{
		$data['products'] = $this->Reports_model->allProductsDropdown();
//		echo $data['products'][0]->product_id;
		$data['biddings'] = $this->Products_model->getAllBidsByProduct($data['products'][0]->product_id);
		$this->load->view('admin/reports/product_biddings',$data);
	}

	public function bidding_ajax(){
		$data['biddings'] = $this->Products_model->getAllBidsByProduct($_POST['id']);
		echo $this->load->view('admin/reports/product_biddings_ajax',$data,true);
	}



}
