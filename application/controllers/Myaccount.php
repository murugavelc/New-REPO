<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {

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
	   $user_id=$_SESSION['user_id']; 
       $edit_result['result']=$this->User_model->edit_myaccount($user_id);
       
	   if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		 $this->load->view('arabic/myaccount',$edit_result);
		}
        else
        {
		   $this->load->view('myaccount',$edit_result);
        }
	}
	
	public function mybiddings()
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
		$data['products'] = $this->Products_model->mybiddings($start,$end);
		$total = $this->Products_model->totalmybiddings();
		 $total_row = count($total);
		//$this->load->view('home',$data);
		$config = array();
		$config["base_url"] = base_url()."myaccount/mybiddings";
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
		//$this->load->view('bidlisting',$data);
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		 $this->load->view('arabic/mybiddings',$data);
		}
        else
        {
		   $this->load->view('mybiddings',$data);
        }
	    
	}
    public function edit_myaccount()
    {   $res1=array();
        $res = array();
        if(isset($_POST))
		{
            $res['input'] = $_POST;
            $res['files'] = $_FILES;
               $day=$_POST['dobdays'];
               $month=$_POST['dobmonth'];
               $year=$_POST['dobyear'];
               $dob=$year . "-" .$month ."-".$day;
               
            $in_arr = array(
                'first_name'    => $_POST['first_name'],
                'middle_name'    => $_POST['middle_name'],
                'last_name'     => $_POST['last_name'],
                'email'         => $_POST['email'],
                'phone'         => $_POST['mobile'],
                'nationality'   => $_POST['nationality'],
                'building_number'  => $_POST['building_number'],
                'address_line'   => $_POST['street_name'],
                'state'         => $_POST['state'],
                'city'         => $_POST['city'],
                'zip_code'     => $_POST['postal_code'],
                'country'         => $_POST['country'],
                'unit_number'         => $_POST['unit_no'],
                'additional_number'  => $_POST['additional_no'],
                'dob'               =>$dob,
                'user_type'     => 4,
                'status'        =>1,
                'approved'      =>0,
                'created_on'    => date('Y-m-d H:i:s',strtotime('now')),
                'updated_on'    => date('Y-m-d H:i:s',strtotime('now')),
            );
				$this->User_model->update_myaccount($in_arr);

				$this->session->set_flashdata('register_success1','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
				<button type="button" class="close" data-dismiss="alert"><span>X</span><span class="sr-only">Close</span></button>
				<span class="text-semibold">Well done!</span> You successfully updated your user account.
			    </div>');
												   
		}
	}
    
	public function mywatchlist()
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
		$data['products'] = $this->Products_model->mywatchlist($start,$end);
		$total = $data['products'];
		$total_row = count($total);
		//$this->load->view('home',$data);
		$config = array();
		$config["base_url"] = base_url()."myaccount/mybiddings";
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
		//$this->load->view('bidlisting',$data);
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		 $this->load->view('arabic/mywatchlist',$data);
		}
        else
        {
		   $this->load->view('mywatchlist',$data);
        }
	   
	}
	public function forget_password_update()
	{
		$old_password=$_POST['old_password'];
		$new_password=$_POST['new_password'];
		$result=$this->User_model->forget_password($old_password,$new_password); 
		$data=trim($result);
		if($data=='1')
		{
		 echo $this->session->set_flashdata('forgot_update_success','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
			<button type="button" class="close" data-dismiss="alert"><span>X</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">Well done!</span> You successfully updated your user Password.
		 </div>');
		}
		else{
		echo $this->session->set_flashdata('forgot_update_error','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
			<button type="button" class="close" data-dismiss="alert"><span>X</span><span class="sr-only">Close</span></button>
			<span class="text-semibold"></span>Password Updataion Failed.
		</div>');
		}
    }
  public function forgetpassword()
  {
	if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		 $this->load->view('arabic/forgetpassword');
		}
        else
        {
		   
		   $this->load->view('forgetpassword'); 
        }
  }
  public function trans()
  {
     
    $apiKey = '<paste your API key here>';
    $text = 'Hello world!';
    $url = 'https://www.googleapis.com/language/translate/v2?key=' . $apiKey . '&q=' . rawurlencode($text) . '&source=en&target=fr';

    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);                 
    $responseDecoded = json_decode($response, true);
    curl_close($handle);

    echo 'Source: ' . $text . '<br>';
    echo 'Translation: ' . $responseDecoded['data']['translations'][0]['translatedText'];

  }
	
    
}
