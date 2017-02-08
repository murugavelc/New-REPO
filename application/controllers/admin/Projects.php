<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends CI_Controller {

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
        $this->load->model('Discussion_model');
        $this->load->library('encrypt');

    }

	public function index()
	{
	    if(!isset($_SESSION['bg_logged']) || $_SESSION['bg_logged'] != 1){
	        redirect('login');
        }
        if($_SESSION['user_type'] == 1) {
            $data['projects'] = $this->Project_model->allProjects();
        }elseif($_SESSION['user_type'] == 2){
            $data['projects'] = $this->Project_model->allClientProjects($_SESSION['user_id']);
        }else{
            $data['projects'] = $this->Project_model->allStaffProjects($_SESSION['user_id']);
        }
		$this->load->view('projects',$data);
	}

    public function add(){
        $data['users'] = $this->User_model->StaffUsers();
        $data['clients'] = $this->User_model->UsersByType(2);
        $this->load->view('add_project', $data);
    }

    public function insert(){
        $res = array();
        if(isset($_POST['project_name'])){
            $res['input'] = $_POST;
            if($this->Project_model->hasProjectName($_POST['project_name'])){
                $res['error']['name'] = "Project name already used";
            }else {
                $se_date = explode(' - ', $_POST['start_end_date']);
                $in_arr = array(
                    'project_name' => $_POST['project_name'],
                    'client_id' => $_POST['client'],
                    'start_date' => date('Y-m-d', strtotime($se_date[0])),
                    'end_date' => date('Y-m-d', strtotime($se_date[1])),
                    'more_info' => $_POST['more_info'],
                    'created_on' => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
                );
                $res['success'] = $this->db->insert(TABLE_PRE . 'projects', $in_arr);
                $pid = $this->db->insert_id();
                foreach ($_POST['project_users'] as $user) {
                    $user_arr = array(
                        'project_id' => $pid,
                        'user_id'   => $user,
                    );
                    $this->db->insert(TABLE_PRE . 'project_users', $user_arr);
                }
                if (!empty($_FILES['project_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/projects/' . $pid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("project_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/projects/' . $pid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/projects/' . $pid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('project_img' => $upload_data['file_name']);
                            $this->db->where('project_id', $pid);
                            $this->db->update(TABLE_PRE . 'projects', $img_update);
                        } else {
                            $res['error']['img'] = 'failed on cropping';
                        }
                    }
                }
            }
        }
        echo json_encode($res);
    }

    public function edit(){
        $id = $this->uri->segment(3);
        if($id == ''){ redirect('projects'); }
        $data['project'] = $this->Project_model->getProjectById($id);
        if(!$data['project']){ redirect('projects'); }
        $data['clients'] = $this->User_model->UsersByType(2);
        $data['users'] = $this->User_model->StaffUsers();
        $data['pusers'] = $this->Project_model->ProjectUserIds($id);
        $this->load->view('edit_project', $data);
    }

    public function update(){
        $res = array();
        if(isset($_POST['project_name'])){
            $res['input'] = $_POST;
            if($this->Project_model->hasProjectName($_POST['project_name'],$_POST['project_id'])){
                $res['error']['name'] = "Project name already used";
            }else {
                $se_date = explode(' - ', $_POST['start_end_date']);
                $in_arr = array(
                    'project_name' => $_POST['project_name'],
                    'client_id' => $_POST['client'],
                    'start_date' => date('Y-m-d', strtotime($se_date[0])),
                    'end_date' => date('Y-m-d', strtotime($se_date[1])),
                    'more_info' => $_POST['more_info'],
                    'created_on' => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on' => date('Y-m-d H:i:s', strtotime('now')),
                );
                $this->db->where('project_id', $_POST['project_id']);
                $res['success'] = $this->db->update(TABLE_PRE . 'projects', $in_arr);

                $this->db->where('project_id',$_POST['project_id']);
                $this->db->delete(TABLE_PRE.'project_users');
                foreach ($_POST['project_users'] as $user) {
                    $user_arr = array(
                        'project_id' => $_POST['project_id'],
                        'user_id'   => $user,
                    );
                    $this->db->insert(TABLE_PRE . 'project_users', $user_arr);
                }
                $pid = $_POST['project_id'];
                if (!empty($_FILES['project_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/projects/' . $pid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("project_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/projects/' . $pid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/projects/' . $pid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('project_img' => $upload_data['file_name']);
                            $this->db->where('project_id', $pid);
                            $this->db->update(TABLE_PRE . 'projects', $img_update);
                        } else {
                            $res['error']['img'] = 'failed on cropping';
                        }
                    }
                }
            }
        }
        echo json_encode($res);
    }

    public function delete(){
        if(isset($_POST['id'])){
            $this->db->where('project_id',$_POST['id']);
            return $this->db->update(TABLE_PRE.'projects',array('status'=>0));
        }
    }

    public function filter(){
        if(isset($_POST['id'])){
            $_SESSION['pro_filter'] = $_POST['id'];

            if($_SESSION['user_type'] == 1) {
                $data['projects'] = $this->Project_model->allProjects();
            }elseif($_SESSION['user_type'] == 2){
                $data['projects'] = $this->Project_model->allClientProjects($_SESSION['user_id']);
            }else{
                $data['projects'] = $this->Project_model->allStaffProjects($_SESSION['user_id']);
            }
            echo $this->load->view('project/projects_ajax',$data,TRUE);
        }
    }

    public function sorting(){
        if(isset($_POST['id'])){
            $_SESSION['pro_sort'] = $_POST['id'];

            if($_SESSION['user_type'] == 1) {
                $data['projects'] = $this->Project_model->allProjects();
            }elseif($_SESSION['user_type'] == 2){
                $data['projects'] = $this->Project_model->allClientProjects($_SESSION['user_id']);
            }else{
                $data['projects'] = $this->Project_model->allStaffProjects($_SESSION['user_id']);
            }
            echo $this->load->view('project/projects_ajax',$data,TRUE);
        }
    }

    public function dashboard(){
        $id = $this->uri->segment(3);
        if($id == ''){ redirect('projects'); }
        $id = decode($id);
        $data['project'] = $this->Project_model->getProjectById($id);
        if(!$data['project']){ redirect('projects'); }
        $data['pusers'] = $this->Project_model->ProjectUsers($id);
        $data['tasks']  = $this->Tasks_model->getRecentsTasksByProject($id);
        $data['taskstatus'] = $this->Tasks_model->getTasksStatusByProject($id);
        $this->load->view('project/project_dashboard',$data);
    }

    public function team_users_popup(){
        if(isset($_POST['pid'])){
            $pid = decode($_POST['pid']);
            $data['pid'] = $_POST['pid'];
            $data['project'] = $this->Project_model->getProjectById($pid);
            $data['pusers'] = $this->Project_model->ProjectUserIds($pid);
            $data['users'] = $this->User_model->StaffUsers();
            echo $this->load->view('ajax/projects/team_users_popup_ajax',$data,TRUE);
        }
    }

    public function updateTeamUsers(){
        $res = array();
        if(isset($_POST['tusers'])){
            $res['input'] = $_POST['tusers'];
            $pid = decode($_POST['pid']);
            $this->db->where('project_id',$pid);
            $this->db->delete(TABLE_PRE.'project_users');
            foreach ($_POST['tusers'] as $user) {
                $user_arr = array(
                    'project_id' => $pid,
                    'user_id'   => $user,
                );
                $this->db->insert(TABLE_PRE . 'project_users', $user_arr);
            }
        }else{
            $res['error'] = '<div class="alert alert-danger alert-styled-left alert-bordered"><button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button><span class="text-semibold">Oh snap!</span> No users selected</a>.</div>';
        }
        echo json_encode($res);
    }

    public function remove_user(){
        $res = array();
        if(isset($_POST['id'])){
            $this->db->where('pu_id',$_POST['id']);
            $res['success'] = $this->db->delete(TABLE_PRE.'project_users');
        }
        echo json_encode($res);
    }

    public function searchProject(){
        if(isset($_POST['psval'])){
            $this->db->select('*')->from(TABLE_PRE.'projects')->where('project_name LIKE "%'.$_POST['psval'].'%"');
            $qry = $this->db->get();
            if($qry->num_rows() > 0){
                foreach ($qry->result() as $project){
                    if($project->project_img != '' && file_exists('./uploads/projects/'.$project->project_id.'/'.$project->project_img)){
                        $profimg = BASE.'uploads/projects/'.$project->project_id.'/'.$project->project_img;
                    }else{
                        $profimg = BASE.'assets/images/placeholder.jpg';
                    }
                    echo '<li><a href="'.BASE.'projects/dashboard/'.encode($project->project_id).'"><img class="img-usr img-circle" src="'.$profimg.'" alt=""> '.$project->project_name.'</a></li>';
                }
            }else{
                echo '<li><a href="">No Results Found</a></li>';
            }
        }
        return FALSE;
    }

    public function tasks(){
        $id = $this->uri->segment(3);
        if($id == ''){ redirect('projects'); }
        $id = decode($id);
        $data['project'] = $this->Project_model->getProjectById($id);
        if(!$data['project']){ redirect('projects'); }
        $data['pusers'] = $this->Project_model->ProjectUsers($id);
        $data['tasks'] = $this->Tasks_model->getTasksByProject($id);
        $this->load->view('project/project_tasks',$data);
    }

    public function taskfilter(){
        if(isset($_POST['id'])){
            $_SESSION['task_filter'] = $_POST['id'];
//            $id = $this->uri->segment(3);
//            $id = decode($id);
            $data['tasks'] = $this->Tasks_model->getTasksByProject($_POST['pid']);
            echo $this->load->view('project/project_tasks_ajax',$data,TRUE);
        }
    }

    public function discussion(){
        $id = $this->uri->segment(3);
        if($id == ''){ redirect('projects'); }
        $id = decode($id);
        $data['project'] = $this->Project_model->getProjectById($id);
        if(!$data['project']){ redirect('projects'); }
        $data['pusers'] = $this->Discussion_model->getDiscussionUsers($id,$data['project']->client_id);
        $this->load->view('project/project_discussion',$data);
    }

}
