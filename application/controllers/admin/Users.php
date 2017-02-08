<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $this->load->library('encrypt');

    }

	public function index()
	{
        $data['users'] = $this->User_model->allUsers(4);
		$this->load->view('admin/users',$data);
	}

    public function admins()
    {
        if($_SESSION['user_type'] != 1){
            redirect('admin/users');
        }
        $data['users'] = $this->User_model->allUsers(2);
        $this->load->view('admin/admin_users',$data);
    }

    public function super_admins()
    {
        if($_SESSION['user_type'] != 1){
            redirect('admin/users');
        }
        $data['users'] = $this->User_model->allUsers(1);
        $this->load->view('admin/super_admin_users',$data);
    }

    public function approvers()
    {
        if($_SESSION['user_type'] != 1){
            redirect('admin/users');
        }
        $data['users'] = $this->User_model->allUsers(5);
        $this->load->view('admin/approvers',$data);
    }

	public function add(){
        $type = $this->uri->segment(4);
        if($type == 1 ) {
            $data['redirect'] = 'users/super_admins';
            $data['title']  = 'Super Admin';
        }elseif($type == 2){
            $data['redirect'] = 'users/admins';
            $data['title']  = 'Salvage Admin';
        }
        GLOBAL $USER_ROLES;
        $data['roles'] = $USER_ROLES;
        $data['countries'] = $this->Common_model->getCountries();
        $this->load->view('admin/add_user',$data);
    }


    public function insert(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            $reset = encode_url($_POST['email']);
            if($this->User_model->hasEmail($_POST['email'])){
                $res['error']['email'] = "Email address already used";
            }else {
                $in_arr = array(
                    'first_name'    => $_POST['first_name'],
                    'middle_name'   => $_POST['middle_name'],
                    'last_name'     => $_POST['last_name'],
                    'email'         => $_POST['email'],
                    'user_type'     => $_POST['role'],
                    'employee_number'   => $_POST['employee_number'],
                    'nationality'   => $_POST['nationality'],
//                    'phone'         => $_POST['phone'],
//                    'country'       => $_POST['country'],
//                    'state'         => $_POST['state'],
//                    'city'          => $_POST['city'],
//                    'zip_code'      => $_POST['zip_code'],
//                    'address_line'  => $_POST['address'],
                    'more_info'     => $_POST['more_info'],
                    'reset'         => $reset,
                    'created_on'    => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );
                $success = $this->db->insert(TABLE_PRE . 'users', $in_arr);
                $uid = $this->db->insert_id();

                if (!empty($_FILES['profile_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/users/' . $uid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("profile_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/users/' . $uid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/users/' . $uid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('profile_img' => $upload_data['file_name']);
                            $this->db->where('user_id', $uid);
                            $this->db->update(TABLE_PRE . 'users', $img_update);
                        } else {
                            $res['error']['img'] = 'failed on cropping';
                        }
                    }
                }
                if (empty($res['error'])) {
                    $data['reset_key'] = $reset;
                    $data['user'] = $_POST;
                    if($_POST['role'] == 3) {
                        $data['subj'] = 'Salvage | Added as Salvage';
                        $email_msg = $this->load->view('salvage/email/new_user_welcome', $data, true);
                    }else{
                        $data['subj'] = 'Salvage | Added as Admin';
                        $email_msg = $this->load->view('admin/email/new_user_welcome', $data, true);
                    }
                    email_sender($_POST['email'], $data['subj'], $email_msg);
                    $res['success'] = "Successfully updated.";
                }
            }
        }
        echo json_encode($res);
    }

    public function activate(){
        if(isset($_SESSION['bg_logged']) && $_SESSION['bg_logged'] == 1){
            redirect('admin/dashboard');
        }
        $key = $this->uri->segment(4);
        if($key == ''){
            redirect('admin/login');
        }
        $email = decode_url($key);
        $query = $this->db->select('user_id')->from(TABLE_PRE.'users')->where('reset',$key)->where('email',$email)->get();
        if($query->num_rows() > 0){
            $this->session->sess_destroy();
            $this->data['user_id'] = $query->row()->user_id;
            $this->load->view('admin/activate_account',$this->data);
        }else{
            redirect('admin/login');
        }
    }

    public function activate_action(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            $in_arr = array(
                'password'  => md5($_POST['password']),
                'reset'     => '',
                'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
            );
            $this->session->set_flashdata('activate_msg', '<div class="alert alert-success alert-styled-left alert-bordered"><button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">Congratulations!</span> Your account has been activated. Login now</a>.</div>');
            $this->db->where('user_id',$_POST['user_id']);
            $res['success'] = $this->db->update(TABLE_PRE.'users',$in_arr);
        }
        echo json_encode($res);
    }

    public function approval(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            $rand_pass = randomPassword();
            $in_arr = array(
                'password'  => md5($rand_pass),
                'approved'  => 1,
                'status'    => 1,
                'approved_by'  => $_SESSION['user_id'],
                'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
            );
            $this->session->set_flashdata('approved_msg', '<div class="alert alert-success alert-styled-left alert-bordered"><button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">Success!</span> User account has been approved.</a>.</div>');
            $this->db->where('user_id',$_POST['id']);
            $res['success'] = $this->db->update(TABLE_PRE.'users',$in_arr);

            $user = $this->User_model->getUserDetById($_POST['id']);

            //$email_msg = 'Your account has been approved. Password: '.$rand_pass.'';
            $data['password'] = $rand_pass;
            $data['subj'] = 'Salvage :: User Approval';
            $data['user'] = $user;
            $email_msg = $this->load->view('admin/email/user_account_approval', $data, true);

            email_sender($user->email, 'Salvage :: User Approval ', $email_msg);
        }
        echo json_encode($res);
    }

    public function edit(){
        $id = $this->uri->segment(4);
        if($id == ''){ redirect('users'); }
        $data['user'] = $this->User_model->getUserDetById($id);
        if(!$data['user']){ redirect('users'); }

        GLOBAL $USER_ROLES;
        $data['roles'] = $USER_ROLES;
        $data['countries'] = $this->Common_model->getCountries();
        if($data['user']->country == 0 || $data['user']->country == ''){
            $sel_country = $data['countries'][0]->id;
        }else{
            $sel_country = $data['user']->country;
        }
        $data['states'] = $this->Common_model->getStatesByCountry($sel_country);
        if($data['user']->state == 0 || $data['user']->state == ''){
            $sel_state = $data['states'][0]->id;
        }else{
            $sel_state = $data['user']->state;
        }
        $data['cities'] = $this->Common_model->getCitiesByState($sel_state);
        if($data['user']->user_type == 1){
            $data['redirect'] = 'users/super_admins';
            $data['title'] = 'Super Admin';
            $this->load->view('admin/edit_staff',$data);
        }elseif($data['user']->user_type == 2){
            $data['redirect'] = 'users/admins';
            $data['title'] = 'Salvage Admin';
            $this->load->view('admin/edit_staff',$data);
        }elseif($data['user']->user_type == 5){
            $data['redirect'] = 'users/approvers';
            $data['title'] = 'Approver';
            $this->load->view('admin/edit_staff',$data);
        }else{
            $data['redirect'] = 'users';
            $data['title'] = '';
            $this->load->view('admin/edit_user',$data);
        }

    }

    public function update(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            if($this->User_model->hasEmail($_POST['email'],$_POST['user_id'])){
                $res['error']['email'] = "Email address already used";
            }else {
                $in_arr = array(
                    'first_name'    => $_POST['first_name'],
                    'middle_name'   => $_POST['middle_name'],
                    'last_name'     => $_POST['last_name'],
                    'email'         => $_POST['email'],
                    'user_type'     => $_POST['role'],
                    'employee_number'   => $_POST['employee_number'],
                    'nationality'   => $_POST['nationality'],
//                    'phone'         => $_POST['phone'],
//                    'country'       => $_POST['country'],
//                    'state'         => $_POST['state'],
//                    'city'          => $_POST['city'],
//                    'zip_code'      => $_POST['zip_code'],
//                    'address_line'  => $_POST['address'],
                    'more_info'     => $_POST['more_info'],
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );
                $this->db->where('user_id',$_POST['user_id']);
                $success = $this->db->update(TABLE_PRE . 'users', $in_arr);
                $uid = $_POST['user_id'];

                if (!empty($_FILES['profile_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/users/' . $uid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("profile_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/users/' . $uid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/users/' . $uid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('profile_img' => $upload_data['file_name']);
                            $this->db->where('user_id', $uid);
                            $this->db->update(TABLE_PRE . 'users', $img_update);
                        } else {
                            $res['error']['img'] = 'failed on cropping';
                        }
                    }
                }
                if (empty($res['error'])) {
                    $res['success'] = "Successfully updated.";
                }
            }
        }
        echo json_encode($res);
    }

    public function update_user(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            if($this->User_model->hasEmail($_POST['email'],$_POST['user_id'])){
                $res['error']['email'] = "Email address already used";
            }else {
                $in_arr = array(
                    'first_name'    => $_POST['first_name'],
                    'middle_name'   => $_POST['middle_name'],
                    'last_name'     => $_POST['last_name'],
                    'email'         => $_POST['email'],
                    'user_type'     => $_POST['role'],
                    'nationality'   => $_POST['nationality'],
                    'building_number'  => $_POST['building_number'],
                    'dob'           => date('Y-m-d',strtotime(''.$_POST['year'].'/'.$_POST['month'].'/'.$_POST['day'].'')),
                    'phone'         => $_POST['phone'],
                    'country'       => $_POST['country'],
                    'state'         => $_POST['state'],
                    'city'          => $_POST['city'],
                    'zip_code'      => $_POST['zip_code'],
                    'address_line'  => $_POST['address'],
                    'unit_number'         => $_POST['unit_number'],
                    'additional_number'  => $_POST['additional_no'],
                    'more_info'     => $_POST['more_info'],
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );
                $this->db->where('user_id',$_POST['user_id']);
                $success = $this->db->update(TABLE_PRE . 'users', $in_arr);
                $uid = $_POST['user_id'];

                if (!empty($_FILES['profile_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/users/' . $uid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("profile_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/users/' . $uid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/users/' . $uid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('profile_img' => $upload_data['file_name']);
                            $this->db->where('user_id', $uid);
                            $this->db->update(TABLE_PRE . 'users', $img_update);
                        } else {
                            $res['error']['img'] = 'failed on cropping';
                        }
                    }
                }
                if (empty($res['error'])) {
                    $res['success'] = "Successfully updated.";
                }
            }
        }
        echo json_encode($res);
    }

    public function view(){
        $id = $this->uri->segment(4);
        if($id == ''){ redirect('users'); }
        $data['user'] = $this->User_model->getUserDetById($id);
        if(!$data['user']){ redirect('users'); }
        GLOBAL $USER_ROLES;
        $data['roles'] = $USER_ROLES;
        $data['countries'] = $this->Common_model->getCountries();
        $this->load->view('admin/view_user',$data);
    }

    public function delete(){
        $res = array();
        if(isset($_POST['id'])){
            $this->db->where('user_id',$_POST['id']);
            $res['success'] = $this->db->update(TABLE_PRE.'users',array('is_deleted' => 1));
        }
        echo json_encode($res);
    }

}
