<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

    }

	public function index()
	{  
	    if(isset($_SESSION['sv_user_logged']) && $_SESSION['sv_user_logged'] == 1){
	        redirect('biddings');
        }
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		 $this->load->view('arabic/login');
		}
        else
        {
		   $this->load->view('login');
        } 		
	}

	public function check_login(){
        $res = array();
        if(isset($_POST)){
		    if (isset($_POST['rememer'])) {
                $this->session->set_userdata('email', $_POST['email']);
                $this->session->set_userdata('password', $_POST['password']);
            } 
            $res['input'] = $_POST;
            $out = $this->User_model->check_login($_POST['email'],$_POST['password'],4);
            if(!empty($out)){
                unset($_SESSION['sv_logged']);
                unset($_SESSION['sv_salvage_logged']);
                $_SESSION['user_id'] = $out->user_id;
                $_SESSION['user_type'] = $out->user_type;
                $_SESSION['sv_user_logged'] = 1;
                $res['success'] = "Logged In";
            }else{
                session_destroy();
                $res['error'] = "<div class=\"alert alert-danger alert-styled-left alert-bordered\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button><span class=\"text-semibold\">Sorry!</span> Your email/password is wrong. Please try again..</a>.</div>";
            }
        }
        echo json_encode($res);
    }

    public function register(){
	  
		if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
		 $this->load->view('arabic/registartion2');
		}
        else
        {
		   $this->load->view('registartion2');
        }
    }

    
public function forgetpassword()
    {  
        if(isset($_SESSION['sv_user_logged']) && $_SESSION['sv_user_logged'] == 1){
            redirect('biddings');
        }
        if(isset($_SESSION['language_status']) && $_SESSION['language_status'] == 1)
        {
         $this->load->view('forgetpass');
        }
        else
        {
           $this->load->view('forgetpass');
        }       
    }

    public function register_action()
    {
        $res = array();
        if(isset($_POST))
        {
            $res['input'] = $_POST;
            $res['files'] = $_FILES;
               $day=$_POST['dobday'];
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
                'dob'                =>$dob,
				'national_id'        =>$_POST['national_id'],
                'user_type'     => 4,
                'status'        =>1,
                'approved'      =>0,
                'created_on'    => date('Y-m-d H:i:s',strtotime('now')),
                'updated_on'    => date('Y-m-d H:i:s',strtotime('now')),
            );
            
            $this->db->select('*');
            $this->db->from('sv_users');
            $this->db->where('email',$_POST['email']);
            $email_check=$this->db->get();
            if($email_check->num_rows() == 0)
            {
            $success = $this->db->insert(TABLE_PRE . 'users', $in_arr);
            $uid = $this->db->insert_id();

            if (!empty($_FILES['file_attach']['tmp_name'])) 
            {

                $config['upload_path'] = './uploads/users/' . $uid . '/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if (!is_dir($config['upload_path'])) 
                {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                if (!$this->upload->do_upload("file_attach")) 
                { //Upload file
                    $res['error']['img'] = $this->upload->display_errors();
                } else 
                {
                    $upload_data = $this->upload->data();

                    if ($upload_data) 
                    {
                        $img_update = array('doc_file' => $upload_data['file_name']);
                        $this->db->where('user_id', $uid);
                        $this->db->update(TABLE_PRE . 'users', $img_update);
                    } else  
                    {
                        $res['error']['img'] = 'failed on cropping';
                    }
                }
            }

                 if($success)
                   {
			    //email function
        			     $data['subj'] = 'Salvage :: Welcome Salvage User';
        				 $data['username'] = $_POST['first_name'].' '.$_POST['last_name'];
        			     $email_msg = $this->load->view('email/register_success', $data, true);
        			     email_sender($_POST['email'], $data['subj'], $email_msg);
                         $res['success'] = 'success';
                         $this->session->set_flashdata('register_success','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
        										<span class="text-semibold">Well done!</span> You successfully registered your user account. Once approved you can use your account.
        								    </div>');
                    }
          }
           else{
            
                $this->session->set_flashdata('email_check','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
										<span class="text-semibold"></span>Email Id already exist.
								    </div>');
            }
       } 
    }


    public function myaccount(){
        $this->load->view('myaccount');
    } 
	
     
    public function logout()
    {
	    $languagesession = $_SESSION['language_status'];
        //session_destroy();
		//$_SESSION['language_status'] = $languagesession;
		 unset($_SESSION['sv_logged']);
		 unset($_SESSION['sv_salvage_logged']);
		 unset($_SESSION['user_id']);
		 unset($_SESSION['user_type']);
		 unset($_SESSION['sv_user_logged']);
         redirect('login');
    }
    public function get_state()
    {
		$country_id = $this->input->post('country');
		$state=$this->User_model->get_states($country_id);
		$responce = '<option value="">-- Select State --</option>';
		foreach($state as $data)
		{
		$responce .= '<option value="'.$data['id'].'">'.$data['name'].'</option>';
		}
		echo json_encode($responce);
	}
    public function  getcities()
    {
            $state_id=$this->input->post('state');
            $cite=$this->User_model->getcitie($state_id); 
            $result='<option value="">-- Select City --</option>';
            foreach($cite as $results){       
            
            $result .='<option value="'.$results['id'].'">'.$results['name'].'</option>';
            
            }
            echo json_encode($result);
            
    }  
	function language_change()
	{
	   
	   if($_POST['lang_id'] == 1)
       {
		 $_SESSION['language_status'] = 1;
       } 
       else
       {	  
		 $_SESSION['language_status'] = 0;
	   }
	   
	}
    
    public function forgotpass()
    {
    
        $email=$this->input->post('email');
        $data=$this->User_model->forgotpass($email);
        
    if($data==1)
        {
            $this->session->set_flashdata('forgot_success','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold">Well done!</span> successfully Forgot password send your Email Id.
            </div>');
            redirect('/Login/forgetpassword', 'refresh');
        }
       else 
        {
            $this->session->set_flashdata('forgot_fail','<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
            <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
            <span class="text-semibold"></span> Invalid Email .
            </div>');
            redirect('/Login/forgetpassword', 'refresh');
        }
   
     }
	 function testsms()
	 {
	   $this->load->helper('Common_helper');
	   $mobileno = '918124604403'; 
	   $text = 'helloo how are you';
	   send_sms($mobileno,$text);
	   
	 }
    
    }


