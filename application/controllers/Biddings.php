<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("display_error",0);
error_reporting(0);
class Biddings extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/biddings
	 *	- or -
	 * 		http://example.com/index.php/biddings/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/biddings/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('User_model');
		$this->load->model('Bidding_model');
		$this->load->model('Products_model');
		$this->load->library('encrypt');
		$this->load->library('pagination');


	}

	public function index()
	{
		if($this->uri->segment(2)){
		 $page = ($this->uri->segment(2)) ;
		}
		else{
		 $page = 1;
		}
		if($page > 1)
		{
		  $start = ($page-1)*10;
		  $end = 10;
		}
		else
		{
		  $start = 10;
		  $end = 0;
		}
		$data['products'] = $this->Products_model->allProducts($start,$end,$_POST);
		$total = $this->Products_model->allProductstotal($_POST);
		 $total_row = count($total);
		//$this->load->view('home',$data);
		$config = array();
		$config["base_url"] = base_url()."biddings";
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
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		   $this->load->view('arabic/bidlisting',$data);
		}
        else
        {
		   $this->load->view('bidlisting',$data);
        }
		
	}


	public function view()
	{

		if(!isset($_SESSION['sv_user_logged']) || $_SESSION['sv_user_logged'] != 1){
			redirect('login');
		}
		
		$id = $this->uri->segment(3);
		if($id == ''){ redirect('biddings'); }
		$data['product'] = $this->Products_model->getProductById($id);
		$data['product_imgs'] = $this->Products_model->getProductImagesById($id);
		$data['current_bid'] = $this->Products_model->getHighestBidByProduct($id);
		$data['total_bids']	= $this->Products_model->getTotalBidsByProduct($id);
		if(!$data['product']){ redirect('error'); }
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		   $this->load->view('arabic/bidlistingdetails',$data);
		}
        else
        {
		   $this->load->view('bidlistingdetails',$data);
        }
	}

	public function bid_insert(){
		$res = array();
		$successfullyupdate = 0;
		if(isset($_POST['amt'])){
			$res['input'] = $_POST;
			$product_base = $this->Products_model->getProductById($_POST['pid']);
			$product_base->base_price;
			$product = $this->Products_model->getProductPriceById($_POST['pid'],$_POST['amt']);
			if($product) {
				if($product->bid_price < $_POST['amt']){
					$in_arr = array(
						'user_id' => $_POST['uid'],
						'product_id' => $_POST['pid'],
						'bid_price' => $_POST['amt'],
					);
					$res['success'] = $this->db->insert(TABLE_PRE . 'biddings', $in_arr);
					$successfullyupdate = 1;
					$update_arr = array(
						'updated_bid_amount' => $_POST['amt'],
					);
					$this->db->where('product_id',$_POST['pid']);
				    $this->db->update(TABLE_PRE . 'products', $update_arr);
				}else {
					$res['error'] = "Try higher bid price";
				}
			}else{
				if($product_base->base_price < $_POST['amt']){
					$in_arr = array(
						'user_id' => $_POST['uid'],
						'product_id' => $_POST['pid'],
						'bid_price' => $_POST['amt'],
					);
					$res['success'] = $this->db->insert(TABLE_PRE . 'biddings', $in_arr);
					$successfullyupdate = 1;
				}else {
					$res['error'] = "Try higher bid price";
				}
			}
			if($successfullyupdate == 1)
			{
			   $product_base = $this->Bidding_model->mailsend_to_all_bid_user($_POST['uid'],$_POST['pid'],$_POST['amt']);
			}
		}
		echo json_encode($res);
	}
	public function autosearch(){
		$result = $this->Products_model->getProductSearchList($_POST['search']);	
		$dropdown = array();
		$count = 0;
		if(count($result)>0 && is_array($result)){
			foreach($result as $key => $value){
				if(stristr($value['brand'],$_POST['search'])){
					$title = $value['brand'];
				} else if(stristr($value['model'],$_POST['search'])){
					$title = $value['model'];
				} else {
					$title = $value['title'];
				} 
				$dropdown["list"][] = array(
					"id"	       => $value['product_id'],
					"product_name" => $title
					);
				$count++;
			}
			$dropdown['count'] = $count;
		} else {
			$dropdown['count'] = 0;
		}
		echo json_encode($dropdown);
	}
	
	public function watchlist_insert()
	{
	    $checkwatchlist = $this->Products_model->checkwatchlist($_POST['uid'],$_POST['pid']);	
		if($checkwatchlist == 0)
		{
			$data = array(
				'user_id' => $_POST['uid'],
				'product_id' => $_POST['pid'],
			);
			$res['success'] = $this->db->insert(TABLE_PRE . 'watch_list', $data);
			echo 1;
		}
        else
        {
		    echo 0;
        }		
	}
	
	public function motor()
	{
	   if($this->uri->segment(3)){
		  $page = ($this->uri->segment(3)) ; 
		}
		else{
		 $page = 1;
		}
		if($page > 1)
		{
		  $start = ($page-1)*10;
		  $end = 10;
		}
		else
		{
		  $start = 10;
		  $end = 0;
		}
		$data['products'] = $this->Products_model->allmotorsProducts($start,$end,$_POST);
		$total = $this->Products_model->allmotorProductstotal($_POST);
		 $total_row = count($total);
		//$this->load->view('home',$data);
		$config = array();
		$config["base_url"] = base_url()."biddings/motor";
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
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		   $this->load->view('arabic/bidlisting',$data);
		}
        else
        {
		   $this->load->view('bidlisting',$data);
        }  
	}
	public function non_motor()
	{
	   if($this->uri->segment(3)){
		  $page = ($this->uri->segment(3)) ; 
		}
		else{
		 $page = 1;
		}
		if($page > 1)
		{
		  $start = ($page-1)*10;
		  $end = 10;
		}
		else
		{
		  $start = 10;
		  $end = 0;
		}
		$data['products'] = $this->Products_model->allnonmotorsProducts($start,$end,$_POST);
		$total = $this->Products_model->allnonmotorProductstotal($_POST);
		 $total_row = count($total);
		//$this->load->view('home',$data);
		$config = array();
		$config["base_url"] = base_url()."biddings/non_motor";
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
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		   $this->load->view('arabic/bidlisting',$data);
		}
        else
        {
		   $this->load->view('bidlisting',$data);
        }  
	}

}
