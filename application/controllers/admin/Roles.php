<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

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
        $this->load->model('User_model');
        $this->load->model('Roles_model');

    }

	public function index()
	{
	    if(!isset($_SESSION['bg_logged']) || $_SESSION['bg_logged'] != 1){
	        redirect('login');
        }
        $data['roles'] = $this->Roles_model->getAllRoles();
		$this->load->view('roles',$data);
	}

	public function add(){

	    if(isset($_POST['type_name'])){
            $res = array();
            $res['input'] = $_POST;
            if($this->Roles_model->hasrolename($_POST['type_name'])){
                $res['error']['type_name'] = "Type name already used";
            }else {
                $in_arr = array(
                    'name' => $_POST['type_name'],
                    'created_on' => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
                );
                $success = $this->db->insert(TABLE_PRE . 'user_types', $in_arr);
                $type_id = $this->db->insert_id();
                GLOBAL $APPMODULES;
                foreach ($APPMODULES as $mkey => $module) {
                    $p_in = array(
                        'type_id' => $type_id,
                        'module_id' => $mkey,
                        'padd' => (isset($_POST['module_' . $mkey . '_add']) ? 1 : 0),
                        'pview' => (isset($_POST['module_' . $mkey . '_view']) ? 1 : 0),
                        'pedit' => (isset($_POST['module_' . $mkey . '_edit']) ? 1 : 0),
                        'pdelete' => (isset($_POST['module_' . $mkey . '_delete']) ? 1 : 0),
                        'created_on' => date('Y-m-d H:i:s', strtotime('now')),
                        'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
                    );
                    $psuc = $this->db->insert(TABLE_PRE . 'user_privilages', $p_in);
                }
                if ($success) {
                    $res['success'] = "Success";
                } else {
                    $res['error']['base'] = "failed to insert";
                }
            }
            echo json_encode($res);
        }else {
            $this->load->view('add_role');
        }
    }

    public function edit(){
        $id = $this->uri->segment(3);
        if($id == ''){
            redirect('roles');
        }
        $data['role'] = $this->Roles_model->getRolesById($id);
        $data['all'] = $this->Roles_model->privilagesAll($data['role']);
        $this->load->view('edit_role',$data);
    }

    public function update(){
        $res = array();
        $res['input'] = $_POST;
        if($this->Roles_model->hasrolename($_POST['type_name'],$_POST['type_id'])){
            $res['error']['type_name'] = "Type name already used";
        }else {
            $in_arr = array(
                'name' => $_POST['type_name'],
                'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
            );
            $this->db->where('type_id',$_POST['type_id']);
            $success = $this->db->update(TABLE_PRE . 'user_types', $in_arr);

            $this->db->where('type_id',$_POST['type_id']);
            $this->db->delete(TABLE_PRE . 'user_privilages');
            GLOBAL $APPMODULES;
            foreach ($APPMODULES as $mkey => $module) {
                $p_in = array(
                    'type_id' => $_POST['type_id'],
                    'module_id' => $mkey,
                    'padd' => (isset($_POST['module_' . $mkey . '_add']) ? 1 : 0),
                    'pview' => (isset($_POST['module_' . $mkey . '_view']) ? 1 : 0),
                    'pedit' => (isset($_POST['module_' . $mkey . '_edit']) ? 1 : 0),
                    'pdelete' => (isset($_POST['module_' . $mkey . '_delete']) ? 1 : 0),
                    'created_on' => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
                );
                $psuc = $this->db->insert(TABLE_PRE . 'user_privilages', $p_in);
            }
            if ($success) {
                $res['success'] = "Success";
            } else {
                $res['error']['base'] = "failed to insert";
            }
        }
        echo json_encode($res);
    }

}
