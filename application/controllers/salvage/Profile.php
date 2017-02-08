<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
        $this->load->model('Roles_model');
        $this->load->model('Common_model');

    }

	public function index()
	{
        $id = $this->session->userdata('user_id');
        if($id == ''){ redirect('dashboard'); }
        $data['user'] = $this->User_model->getUserDetById($id);
        if(!$data['user']){ redirect('users'); }
        GLOBAL $USER_ROLES;
        $data['roles'] = $USER_ROLES;
        $data['countries'] = $this->Common_model->getCountries();
        $data['redirect'] = 'profile';
        $this->load->view('salvage/edit_user',$data);
	}

    public function edit(){
        $id = $this->session->userdata('user_id');
        if($id == ''){ redirect('dashboard'); }
        $data['user'] = $this->User_model->getUserDetById($id);
        if(!$data['user']){ redirect('users'); }
        $data['roles'] = $this->Roles_model->getAllRoles();
        $data['countries'] = $this->Common_model->getCountries();
        $data['redirect'] = 'profile';
        $this->load->view('edit_user',$data);
    }

}
