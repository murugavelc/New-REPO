<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussions extends CI_Controller {

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
        $this->load->model('Message_model');
        $this->load->model('Discussion_model');
        $this->load->library('encrypt');

    }

	public function index()
	{
	    if(!isset($_SESSION['bg_logged']) || $_SESSION['bg_logged'] != 1){
	        redirect('login');
        }
        $data['recent'] = $this->Message_model->TotalRecent();
        $data['users'] = $this->Message_model->getAllUsersMe();
        $data['groups'] = $this->Message_model->getAllGroups();
		$this->load->view('messages',$data);
	}

	public function add_message(){
	    $res = array();
        if(isset($_POST)) {
            $res['input'] = $_POST;
            $userid = $_SESSION['user_id'];
            $pid = $_POST['project_id'];
            $name_array = array();
            $config['upload_path'] = './uploads/discussion/' . $pid . '/';
            $config['allowed_types'] = 'gif|jpg|png|xml|doc|docx|zip|xls|xlsx|pdf';
            $config['max_size'] = '10000';
            $this->load->library('upload');
            if(!empty($_FILES['userfile']['tmp_name'][0])) {
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $files = $_FILES;
                $count = count($_FILES['userfile']['name']);
                for($i=0; $i<$count; $i++) {
                    $_FILES['userfile']['name']= date('mdY_hia').'_'.$files['userfile']['name'][$i];
                    $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']= $files['userfile']['size'][$i];
                    $this->upload->initialize($config);
                    if($this->upload->do_upload() == False) {
                        // echo 'error';
                    }
                    else {
                        $upload_data = $this->upload->data();
                        $in_arr = array(
                            'project_id'    => $pid,
                            'sender'        => $_SESSION['user_id'],
                            'reciver'       => $_POST['active_user'],
                            'file'          => $upload_data['file_name'],
                            'datetime'      => date('Y-m-d H:i:s', strtotime('now')),
                        );
                        $res['success'] = $this->db->insert(TABLE_PRE . 'discussions', $in_arr);
                    }
                }
            }

            if($_POST['msg'] != '') {
                $in_arr = array(
                    'project_id'    => $pid,
                    'sender'        => $_SESSION['user_id'],
                    'reciver'       => $_POST['active_user'],
                    'message'       => $_POST['msg'],
                    'datetime'      => date('Y-m-d H:i:s', strtotime('now')),
                );
                $res['success'] = $this->db->insert(TABLE_PRE . 'discussions', $in_arr);
            }
        }
        echo json_encode($res);
    }

    public function add_group(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            if($this->Message_model->hasGroupName($_POST['group_name'])){
                $res['error']['name'] = "Group name already used";
            }else {
                $in_arr = array(
                    'group_name'    => $_POST['group_name'],
                    'created_date'    => date('Y-m-d H:i:s', strtotime('now')),
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );
                $success = $this->db->insert(TABLE_PRE . 'msg_groups', $in_arr);
                $uid = $this->db->insert_id();
//                $_POST['group_users'][] = $_SESSION['user_id'];
                $ad_arr = array(
                    'group_id' => $uid,
                    'user_id'  => $_SESSION['user_id'],
                    'is_admin'  => 1
                );
                $this->db->insert(TABLE_PRE . 'msg_group_users', $ad_arr);
                foreach ($_POST['group_users'] as $gusr){
                    $ing_arr = array(
                        'group_id' => $uid,
                        'user_id'  => $gusr,
                    );
                    $this->db->insert(TABLE_PRE . 'msg_group_users', $ing_arr);
                }

                if (!empty($_FILES['group_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/message/group/' . $uid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("group_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/message/group/' . $uid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/message/group/' . $uid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('group_img' => $upload_data['file_name']);
                            $this->db->where('group_id', $uid);
                            $this->db->update(TABLE_PRE . 'msg_groups', $img_update);
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

    public function add_grp_message(){
        $res = array();
        if(isset($_POST)) {
            $res['input'] = $_POST;
            $userid = $_SESSION['user_id'];
            $name_array = array();
            $config['upload_path'] = './uploads/message/group/' . $_POST['active_user'] . '/';
            $config['allowed_types'] = 'gif|jpg|png|xml|doc|docx|zip|xls|xlsx|pdf';
            $config['max_size'] = '10000';
//            $config['remove_spaces'] = FALSE;
            $this->load->library('upload');
            if(!empty($_FILES['userfile']['tmp_name'][0])) {
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $files = $_FILES;
                $count = count($_FILES['userfile']['name']);
                for($i=0; $i<$count; $i++) {
                    $_FILES['userfile']['name']= date('mdY_hia').'_'.$files['userfile']['name'][$i];
                    $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']= $files['userfile']['size'][$i];
                    $this->upload->initialize($config);
                    if($this->upload->do_upload() == False) {
                        // echo 'error';
                    }
                    else {
                        $upload_data = $this->upload->data();

                        $in_arr = array(
                            'sender' => $_SESSION['user_id'],
                            'group_id' => $_POST['active_user'],
                            'file' => $upload_data['file_name'],
                            'datetime' => date('Y-m-d H:i:s', strtotime('now')),
                        );
                        $res['success'] = $this->db->insert(TABLE_PRE . 'messages', $in_arr);
                    }
                }
            }

            if($_POST['msg'] != '') {
                $in_arr = array(
                    'sender' => $_SESSION['user_id'],
                    'group_id' => $_POST['active_user'],
                    'message' => $_POST['msg'],
                    'datetime' => date('Y-m-d H:i:s', strtotime('now')),
                );
                $res['success'] = $this->db->insert(TABLE_PRE . 'messages', $in_arr);
            }
        }
        echo json_encode($res);
    }


    public function chat_userList(){
        $res = array();
        if(isset($_POST)) {
            $data['input'] = $_POST;
            $data['active'] = $_POST['uid'];
            $data['project'] = $this->Project_model->getProjectById($_POST['pid']);
            $data['pusers'] = $this->Discussion_model->getDiscussionUsers($_POST['pid'],$data['project']->client_id);
            $res['recent'] = $this->load->view('ajax/discussion_userlist',$data,true);
        }
        echo json_encode($res);
    }

    public function view_userdata(){
        $res = '';
        if(isset($_POST)) {
            $data['input'] = $_POST;
            if(isset($_POST['group']) && $_POST['group'] != 0){
                $data['group'] = $this->Message_model->getGroupById($_POST['uid']);
                $data['group_users'] = $this->Message_model->getGroupUsersByGroup($_POST['uid']);
                $data['is_admin'] = $this->Message_model->isAdminGroup($_SESSION['user_id'],$_POST['uid']);
            }else {
                $data['user'] = $this->User_model->getUserDetById($_POST['uid']);
            }
            $res = $this->load->view('ajax/view_user_message',$data,true);
        }
        echo $res;
    }

    public function edit_group(){
        $res = '';
        if(isset($_POST)) {
            $data['input'] = $_POST;
            $data['group'] = $this->Message_model->getGroupById($_POST['gid']);
            $data['group_users'] = $this->Message_model->getGroupUsersByGroup($_POST['gid']);
            $data['users'] = $this->Message_model->getAllUsersMe();
            $res = $this->load->view('ajax/view_edit_group',$data,true);
        }
        echo $res;
    }

    public function update_group(){
        $res = array();
        if(isset($_POST)){
            $res['input'] = $_POST;
            if($this->Message_model->hasGroupName($_POST['group_name'],$_POST['group_id'])){
                $res['error']['name'] = "Group name already used";
            }else {
                $in_arr = array(
                    'group_name'    => $_POST['group_name'],
                    'updated_on'    => date('Y-m-d H:i:s', strtotime('now')),
                );
                $this->db->where('group_id',$_POST['group_id']);
                $success = $this->db->update(TABLE_PRE . 'msg_groups', $in_arr);
                $uid = $_POST['group_id'];
//                $_POST['group_users'][] = $_SESSION['user_id'];
                $this->db->where('group_id',$_POST['group_id']);
                $this->db->delete(TABLE_PRE.'msg_group_users');
                $ad_arr = array(
                    'group_id' => $uid,
                    'user_id'  => $_SESSION['user_id'],
                    'is_admin'  => 1
                );
                $this->db->insert(TABLE_PRE . 'msg_group_users', $ad_arr);
                foreach ($_POST['group_users'] as $gusr){
                    $ing_arr = array(
                        'group_id' => $uid,
                        'user_id'  => $gusr,
                    );
                    $this->db->insert(TABLE_PRE . 'msg_group_users', $ing_arr);
                }

                if (!empty($_FILES['group_img']['tmp_name'])) {

                    $config['upload_path'] = './uploads/message/group/' . $uid . '/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '0';
                    $config['max_width'] = '0';
                    $config['max_height'] = '0';

                    $this->load->library('upload', $config);

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, TRUE);
                    }

                    if (!$this->upload->do_upload("group_img")) { //Upload file
                        $res['error']['img'] = $this->upload->display_errors();
                    } else {
                        $upload_data = $this->upload->data();
                        $res['upload'] = $upload_data;

                        $config["source_image"] = './uploads/message/group/' . $uid . '/' . $upload_data['file_name'];
                        $config['new_image'] = './uploads/message/group/' . $uid . '/' . $upload_data['file_name'];
                        $config["width"] = 200;
                        $config["height"] = 200;

                        $this->load->library('image_lib', $config);
                        $img_success = $this->image_lib->fit();

                        if ($img_success) {
                            $img_update = array('group_img' => $upload_data['file_name']);
                            $this->db->where('group_id', $uid);
                            $this->db->update(TABLE_PRE . 'msg_groups', $img_update);
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

    public function get_messages_by_user(){
        $uid = $this->input->post('userid');
        $pid = $this->input->post('project');
        $group_msg = $this->Discussion_model->grouped_message($uid,$pid);
        if(!empty($group_msg)) {
            echo '<ul>';
            foreach ($group_msg as $group) {
                $cdate = '';
                if (date('M d, Y', strtotime('now')) == $group['cdate']) {
                    $cdate = "Today";
                } elseif (date('M d, Y', strtotime('-1 days')) == $group['cdate']) {
                    $cdate = "Yesterday";
                } else {
                    $cdate = date('M d, Y', strtotime($group['cdate']));
                }

                echo '<div class="devider"><div><p>' . $cdate . '</p></div></div>';
                $this->umessage = $this->Discussion_model->messagelist($uid,$pid,$group['cdate']);
                foreach($this->umessage as $umessage) {
                    $msg_id = $umessage['mid'];

                  $user_image = BASE.'assets/images/placeholder.jpg';

                    if($_SESSION['user_id'] == $umessage['sender']) {
                        $send_user = $this->User_model->getUserDetById($umessage['sender']);
                        if($send_user->profile_img != '') {
                            $user_image = BASE.'/uploads/users/'.$send_user->user_id.'/'.$send_user->profile_img;
                        }
                        echo '<li id="'.$umessage['mid'].'" class="mar-btm">
                                    <div class="media-left">
                                        <img src="'.$user_image.'" class="img-circle img-sm" alt="Profile Picture">
                                    </div>
                                    <div class="media-body pad-hor">
                                        <div class="speech">
                                            <a href="#" class="media-heading">'.$send_user->first_name.' '.$send_user->last_name.'</a>';
                                            if($umessage['message'] != ''){
                                                echo '<p>'.$umessage['message'].'</p>';
                                            }elseif($umessage['message'] == '' && $umessage['file'] != ''){
                                                echo '<a href="'.BASE.'uploads/discussion/'.$pid.'/'.$umessage['file'].'" target="_blank"><img  width="140px" src="'.BASE.'uploads/discussion/'.$pid.'/'.$umessage['file'].'"></a>';
                                            }
                                            echo '<p class="speech-time">
                                                <i class="fa fa-clock-o fa-fw"></i>'.date('g:i A',strtotime($umessage['datetime'])).'
                                            </p>
                                        </div>
                                    </div>
                                </li>';
                } else {
                    $recive_user = $this->User_model->getUserDetById($umessage['sender']);
                    if($recive_user->profile_img != '') {
                        $user_image = BASE.'uploads/users/'.$recive_user->user_id.'/'.$recive_user->profile_img;
                    }
                        echo '<li id="'.$umessage['mid'].'" class="mar-btm">
                                    
                                    <div class="media-body pad-hor speech-right">
                                        <div class="speech">
                                            <a href="#" class="media-heading">'.$recive_user->first_name.' '.$recive_user->last_name.'</a>';
                                            if($umessage['message'] != ''){
                                                echo '<p>'.$umessage['message'].'</p>';
                                            }elseif($umessage['message'] == '' && $umessage['file'] != ''){
                                                echo '<a href="'.BASE.'uploads/discussion/'.$pid.'/'.$umessage['file'].'" target="_blank"><img  width="140px" src="'.BASE.'uploads/discussion/'.$pid.'/'.$umessage['file'].'"></a>';
                                            }
                                            echo '<p class="speech-time">
                                                <i class="fa fa-clock-o fa-fw"></i>'.date('g:i A',strtotime($umessage['datetime'])).'
                                            </p>
                                        </div>
                                    </div>
                                    <div class="media-right">
                                        <img src="'.$user_image.'" class="img-circle img-sm" alt="Profile Picture">
                                    </div>
                                </li>';
                }
              }
            }
            echo '</ul>';
        }else{
            echo '<div class="devider"><div><p>No Messages Found</p></div></div>';
        }
    }

    public function searchUsers(){
        $res = '';
        if(isset($_POST['seval'])){
            $data['project'] = $this->Project_model->getProjectById($_POST['pid']);
            $data['pusers'] = $this->Discussion_model->searchRes($_POST['seval'],$_POST['pid'],$data['project']->client_id);
            $res = $this->load->view('ajax/discussion_searchUsers',$data,TRUE);
        }
        echo $res;
    }

    public function update_read(){
        if(isset($_POST['uid']) && isset($_POST['pid'])){
            if($_POST['uid'] == 0){
                $this->db->where('reciver',0);
            }else {
                $this->db->where('(sender=' . $_POST['uid'] . ' AND reciver=' . $_SESSION['user_id'] . ')');
            }
            $this->db->where('project_id',$_POST['pid']);
            return $this->db->update(TABLE_PRE.'discussions',array('is_read'=>1));
        }
    }

}
