<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

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
        $this->load->model('Roles_model');
        $this->load->model('User_model');
        $this->load->model('Project_model');
        $this->load->model('Tasks_model');
        $this->load->library('encrypt');

    }

	public function index()
	{
	    if(!isset($_SESSION['bg_logged']) || $_SESSION['bg_logged'] != 1){
	        redirect('login');
        }
        if($_SESSION['user_type'] == 1) {
            $data['tasks'] = $this->Tasks_model->allTasks();
        }elseif($_SESSION['user_type'] == 2){
            $data['tasks'] = $this->Tasks_model->allClientTasks($_SESSION['user_id']);
        }else{
            $data['tasks'] = $this->Tasks_model->allStaffTasks($_SESSION['user_id']);
        }
		$this->load->view('tasks',$data);
	}

    public function add(){
        $data['projects'] = $this->Project_model->allProjects();
        $data['project_users'] = $this->Project_model->ProjectUsers($data['projects'][0]->project_id);
        $this->load->view('add_task', $data);
    }

    public function add_task_ajax(){
        if(isset($_POST['pid'])) {
            $pid = decode($_POST['pid']);
            $data['project_id'] = $pid;
            $data['project_users'] = $this->Project_model->ProjectUsers($pid);
            echo $this->load->view('ajax/task/add_task_ajax', $data, TRUE);
        }
    }

    public function insert(){
        $res = array();
        if(isset($_POST['task_name'])){
            $res['input'] = $_POST;
            if($this->Tasks_model->hasTaskName($_POST['task_name'])){
                $res['error']['name'] = "Task name already used";
            }else {

                $sno = $this->Tasks_model->totalTasks($_POST['project'])+1;
                $se_date = explode(' - ', $_POST['due_date']);
                $in_arr = array(
                    'title'         => $_POST['task_name'],
                    'sno'           => $sno,
                    'project_id'    => $_POST['project'],
                    'due_on'        => date('Y-m-d', strtotime($_POST['due_date'])),
                    'description'   => $_POST['more_info'],
                    'created_by'    => $this->session->userdata('user_id'),
                    'created_on'    => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );

                if (!empty($_FILES['attach_file']['tmp_name'])) {

                    $config['upload_path'] = './uploads/projects/' . $_POST['project'] . '/tasks/'.$sno.'/';
                    $config['allowed_types'] = '*';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("attach_file")) { //Upload file
                        $res['error']['attachment'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $in_arr['attachment'] = $upload_data['file_name'];
                    }
                }
                $res['input_insert'] = $in_arr;
                if(empty($res['error'])) {
//                    foreach ($_POST['projectUsers'] as $usr) {
                        $in_arr['assigned_to'] = $_POST['projectUsers'];
                        $res['success'] = $this->db->insert(TABLE_PRE . 'tasks', $in_arr);
//                    }
                }
            }
        }
        echo json_encode($res);
    }

    public function edit(){
        $id = $this->uri->segment(3);
        if($id == ''){ redirect('tasks'); }
        $data['task'] = $this->Tasks_model->getTaskById($id);
        if(!$data['task']){ redirect('tasks'); }
        $data['projects'] = $this->Project_model->allProjects();
        $data['project_users'] = $this->Project_model->ProjectUsers($data['projects'][0]->project_id);
        $this->load->view('edit_task', $data);
    }

    public function edit_task_ajax(){
        if(isset($_POST['tid'])) {
            $id = $_POST['tid'];
            $pid = decode($_POST['pid']);
            $data['project_id'] = $pid;
            if($id == ''){ redirect('tasks'); }
            $data['task'] = $this->Tasks_model->getTaskById($id);
            if(!$data['task']){ redirect('tasks'); }
            $data['project_users'] = $this->Project_model->ProjectUsers($pid);
            echo $this->load->view('ajax/task/edit_task_ajax', $data, TRUE);
        }
    }

    public function update(){
        $res = array();
        if(isset($_POST['task_name'])){
            $this->session->set_flashdata('tid',$_POST['task_id']);
            $res['input'] = $_POST;
            if($this->Tasks_model->hasTaskName($_POST['task_name'], $_POST['task_id'])){
                $res['error']['name'] = "Task name already used";
            }else {

                $se_date = explode(' - ', $_POST['due_date']);
                $in_arr = array(
                    'title'         => $_POST['task_name'],
                    'due_on'        => date('Y-m-d', strtotime($_POST['due_date'])),
                    'description'   => $_POST['more_info'],
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );

                if (!empty($_FILES['attach_file']['tmp_name'])) {

                    $config['upload_path'] = './uploads/projects/' . $_POST['project_id'] . '/tasks/'.$_POST['sno'].'/';
                    $config['allowed_types'] = '*';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("attach_file")) { //Upload file
                        $res['error']['attachment'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $in_arr['attachment'] = $upload_data['file_name'];
                    }
                }
                $res['input_insert'] = $in_arr;
                if(empty($res['error'])) {
                    $in_arr['assigned_to'] = $_POST['projectUsers'];
                    $this->db->where('task_id',$_POST['task_id']);
                    $res['success'] = $this->db->update(TABLE_PRE . 'tasks', $in_arr);
                }
            }
        }
        echo json_encode($res);
    }

    public function view(){
        $id = $this->uri->segment(3);
        if($id == ''){ redirect('tasks'); }
        $id = decode($id);
        $data['task'] = $this->Tasks_model->getTaskById($id);
        if(!$data['task']){ redirect('tasks'); }
        $data['comments'] = $this->Tasks_model->getTaskComments($id,$data['task']->project_id);
        $this->load->view('task_view',$data);
    }

    public function comment_insert(){
        $res = array();
        if(isset($_POST['task_comment'])){
            $this->session->set_flashdata('tid',$_POST['task_id']);
            $this->session->set_flashdata('cmnt',TRUE);
            $res['input'] = $_POST;
            $task = $this->Tasks_model->getTaskById($_POST['task_id']);

            $in_arr = array(
                'project_id'    => $task->project_id,
                'task_id'       => $_POST['task_id'],
                'user_id'       => $this->session->userdata('user_id'),
                'comment'       => $_POST['task_comment'],                
                'created_on'    => date('Y-m-d H:i:s', strtotime('now')),
            );

            if(isset($_POST['task_status'])){
                $in_arr['status'] = $_POST['task_status'];
                $this->db->where('task_id',$_POST['task_id']);
                $res['status_up'] = $this->db->update(TABLE_PRE.'tasks',array('status'=>$_POST['task_status']));
            }

            if (!empty($_FILES['attachment']['tmp_name'])) {

                $config['upload_path'] = './uploads/projects/' . $task->project_id . '/tasks/'.$task->sno.'/';
                $config['allowed_types'] = '*';
                $config['overwrite'] = TRUE;
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';

                $this->load->library('upload', $config);

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0755, TRUE);
                }

                if (!$this->upload->do_upload("attachment")) { //Upload file
                    $res['error']['attachment'] = $this->upload->display_errors();
                } else {
                    $upload_data = $this->upload->data();
                    $in_arr['attachment'] = $upload_data['file_name'];
                }
            }
            $res['input_insert'] = $in_arr;
            if(empty($res['error'])) {
                    $res['success'] = $this->db->insert(TABLE_PRE . 'task_comments', $in_arr);
            }
            
        }
        echo json_encode($res);
    }

    public function task_preview(){
        if(isset($_POST['tid'])) {
            $id = $_POST['tid'];
            if ($id == '') {
                redirect('tasks');
            }
//            $id = decode($id);
            $data['task'] = $this->Tasks_model->getTaskById($id);
            if (!$data['task']) {
                redirect('tasks');
            }
            $data['comments'] = $this->Tasks_model->getTaskComments($id, $data['task']->project_id);
            echo $this->load->view('task_preview', $data, TRUE);
        }
    }

}
