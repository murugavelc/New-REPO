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
        $this->load->library('encrypt');
    }

	public function index()
	{
	    if(isset($_SESSION['sv_salvage_logged']) && $_SESSION['sv_salvage_logged'] == 1){
	        redirect('salvage/products');
        }
		$this->load->view('salvage/login');
	}

	public function check_login(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            $out = $this->User_model->check_login($_POST['email'],$_POST['password'],3);
//            $res['out'] = $out;
//            $res['query'] = $this->db->last_query();
            if(!empty($out)){
                unset($_SESSION['sv_user_logged']);
                unset($_SESSION['sv_logged']);
                $_SESSION['user_id'] = $out->user_id;
                $_SESSION['user_type'] = $out->user_type;
                $_SESSION['sv_salvage_logged'] = 1;
                $res['success'] = "Logged In";
            }else{
                session_destroy();
                $res['error'] = "<div class=\"alert alert-danger alert-styled-left alert-bordered\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><span>×</span><span class=\"sr-only\">Close</span></button><span class=\"text-semibold\">Sorry!</span> Your email/password is wrong. Please try again..</a>.</div>";
            }
        }
        echo json_encode($res);
    }

    public function forgot_password(){
        $this->load->view('salvage/forgot_password');
    }

    public function forgot_password_action(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            $this->db->where('email',$_POST['email']);
            $this->db->where('(user_type = 3)');
            $this->db->select('*')->from(TABLE_PRE.'users');
            $query = $this->db->get();
            if($query->num_rows() > 0){

                $user = $query->row();
                $reset = encode_url($_POST['email']);
                $data['reset_key'] = $reset;

                $this->db->where('email',$_POST['email']);
                $res['success'] = $this->db->update(TABLE_PRE.'users',array('reset' => $reset));

                $this->session->set_flashdata('activate_msg', '<div class="alert alert-success alert-styled-left alert-bordered"><button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">Congratulations!</span> Check your mail to reset password</a>.</div>');

                $data['subj'] = 'Salvage | Forgot Password';
                $data['user'] = $user;
                $email_msg = $this->load->view('salvage/email/reset_password', $data, true);
                //$email_msg = 'Click To Reset Password : <a href="'.SALVAGE_URL.'login/reset/'.$reset.'">'.SALVAGE_URL.'login/reset/'.$reset.'</a>';

                email_sender($_POST['email'], $data['subj'], $email_msg);
            }else{
                $res['error'] = "No account available for this email";
            }
        }
        echo json_encode($res);
    }

    public function reset(){
        if(isset($_SESSION['bg_logged']) && $_SESSION['bg_logged'] == 1){
            redirect('salvage/dashboard');
        }
        $key = $this->uri->segment(4);
        if($key == ''){
            redirect('salvage/login');
        }
        $email = decode_url($key);
        $query = $this->db->select('user_id')->from(TABLE_PRE.'users')->where('reset',$key)->where('email',$email)->get();
        if($query->num_rows() > 0){
            $this->session->sess_destroy();
            $this->data['user_id'] = $query->row()->user_id;
            $this->load->view('salvage/reset_password',$this->data);
        }else{
            redirect('salvage/login');
        }
    }

    public function reset_action(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            $in_arr = array(
                'password'  => md5($_POST['password']),
                'reset'     => '',
                'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
            );
            $this->session->set_flashdata('activate_msg', '<div class="alert alert-success alert-styled-left alert-bordered"><button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">Congratulations!</span> Your password has been reset. Login now</a>.</div>');
            $this->db->where('user_id',$_POST['user_id']);
            $res['success'] = $this->db->update(TABLE_PRE.'users',$in_arr);
        }
        echo json_encode($res);
    }

    public function logout(){
        session_destroy();
        redirect('salvage/products');
    }
}
