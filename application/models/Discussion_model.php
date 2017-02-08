<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getDiscussionUsers($pid,$clid){
        $cquery = $this->db->select('user_id,first_name,last_name,profile_img')->from(TABLE_PRE.'users')->where('user_id',$clid);
        $cquery = $this->db->get()->row_array();
        $cquery['project_id'] = $pid;

        if($_SESSION['user_id'] != 1) {
            $aquery = $this->db->select('user_id,first_name,last_name,profile_img')->from(TABLE_PRE . 'users')->where('user_id', 1);
            $aquery = $this->db->get()->row_array();
            $aquery['project_id'] = $pid;
        }

        $this->db->select('a.project_id,a.user_id,b.first_name,b.last_name,b.profile_img')->from('bg_project_users as a');
        $this->db->join(TABLE_PRE.'users as b','a.user_id = b.user_id');
        $this->db->where('a.project_id',$pid);
        $this->db->where('a.user_id !=',$_SESSION['user_id']);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $result = $query->result_array();
            $result[] = $cquery;
            if($_SESSION['user_id'] != 1) { $result[] = $aquery; }
            $ures = array();
            foreach ($result as $res){
                $this->db->where('(sender ='.$res['user_id'].' OR reciver ='.$res['user_id'].')');
                $this->db->where('project_id',$pid);
                $this->db->select('*')->from('bg_discussions')->order_by('datetime','DESC');
                $dqry = $this->db->get();
                $msg  = '';
                if($dqry->num_rows() > 0){
                    $msg = $dqry->row_array();
                }
                $ures[] = array(
                    'project_id'    => $pid,
                    'user_id'       => $res['user_id'],
                    'first_name'    => $res['first_name'],
                    'last_name'     => $res['last_name'],
                    'profile_img'   => $res['profile_img'],
                    'message'       => (isset($msg['message'])?$msg['message']:''),
                    'datetime'      => (isset($msg['datetime'])?$msg['datetime']:'0000-00-00 00:00:00'),
                    'unread'        => $this->getTotalUnread($res['user_id'],$pid),
                );
            }
            usort($ures, array("Discussion_model", "sortFunction"));
            return array_reverse($ures);
        }
        return false;
    }

    public function getTotalUnread($uid,$pid){
        $this->db->where('(sender=' . $uid . ' AND reciver=' . $_SESSION['user_id'] . ')');
        $this->db->where('project_id',$pid);
        $this->db->where('is_read',0);
        return $this->db->count_all_results(TABLE_PRE.'discussions');
    }

    function sortFunction( $a, $b ) {
        return strtotime($a["datetime"]) - strtotime($b["datetime"]);
    }

    public function getLastOfProjectall($pid){
        $this->db->where('reciver',0);
        $this->db->where('project_id',$pid);
        $this->db->select('*')->from('bg_discussions')->order_by('datetime','DESC');
        $dqry = $this->db->get();
        if($dqry->num_rows() > 0){
            return $dqry->row_array();
        }
        return false;
    }

    public function TotalRecent(){
        $group = $this->groupRecent();
        $user = $this->UsersRecent();
        if(($group == false || empty($group)) AND !empty($user)) {
            $recent = $user;
        }elseif(!empty($group) AND ($user == false || empty($user))) {
            $recent = $group;
        }elseif(!empty($group) AND !empty($user)){
            $recent = array_merge($group, $user);
        }else{
            $recent = array();
        }

        usort($recent, array("Discussion_model", "sortFunction"));
        return array_reverse($recent);
    }

    public function groupRecent(){
        $result = array();
        $user_id = $_SESSION['user_id'];
        $query = $this->db->query('SELECT a.group_id,a.user_id,a.is_admin,b.group_name,b.group_img FROM `bg_discussion_group_users` as `a` LEFT JOIN `bg_discussion_groups` as `b` ON `a`.`group_id` = `b`.`group_id` WHERE a.user_id = '.$user_id.'');
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $grp) {
                $qry = $this->db->query('SELECT * FROM bg_discussions WHERE group_id = '.$grp['group_id'].' ORDER BY datetime DESC LIMIT 1');
                if($qry->num_rows() > 0){
                    $msg = $qry->row_array();
                    $result[] = array(
                        'gu_id'     => $grp['group_id'],
                        'is_group'  => 1,
                        'name'      => $grp['group_name'],
                        'img'       => $grp['group_img'],
                        'mid'       => $msg['mid'],
                        'sender'    => $msg['sender'],
                        'message'   => $msg['message'],
                        'file'      => $msg['file'],
                        'datetime'  => $msg['datetime'],
                        'is_read'   => $msg['is_read'],
                    );
                }
            }
        }
        return $result;
    }

    public function UsersRecent(){
        if($_SESSION['user_type'] == 2) {
            $allowded = array(1);
            $query = $this->db->query('SELECT * FROM `bg_users` as `a` LEFT JOIN `bg_messages` as `b` ON `a`.`user_id` = `b`.`sender` OR `a`.`user_id` = `b`.`reciver` WHERE (`b`.`sender` = ' . $_SESSION['user_id'] . ' OR `b`.`reciver` =' . $_SESSION['user_id'] . ') AND `user_id` != ' . $_SESSION['user_id'] . ' AND user_id IN ('.implode(',',$allowded).') ORDER BY `datetime` DESC');
        }else{
            $query = $this->db->query('SELECT * FROM `bg_users` as `a` LEFT JOIN `bg_messages` as `b` ON `a`.`user_id` = `b`.`sender` OR `a`.`user_id` = `b`.`reciver` WHERE (`b`.`sender` = ' . $_SESSION['user_id'] . ' OR `b`.`reciver` =' . $_SESSION['user_id'] . ') AND `user_id` != ' . $_SESSION['user_id'] . ' ORDER BY `datetime` DESC');
        }
        $used = array();
        $latest = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $result){
                if (!in_array($result->user_id, $used)) {
                    $used[] = $result->user_id;
                    $latest[] = array(
                        'gu_id'     => $result->user_id,
                        'is_group'  => 0,
                        'name'      => $result->first_name.' '.$result->last_name,
                        'img'       => $result->profile_img,
                        'mid'       => $result->mid,
                        'sender'    => $result->sender,
                        'message'   => $result->message,
                        'file'      => $result->file,
                        'datetime'  => $result->datetime,
                        'is_read'   => $result->is_read,
                    );
                }
            }
            return $latest;
        }
        return false;
    }

    public function getAllUsersMe(){
        if($_SESSION['user_type'] == 2) {
            $allowded = array(1);
            $query = $this->db->query('SELECT * FROM `bg_users` as `a` LEFT JOIN `bg_messages` as `b` ON `a`.`user_id` = `b`.`sender` OR `a`.`user_id` = `b`.`reciver` WHERE `user_id` != ' . $_SESSION['user_id'] . ' AND user_id IN ('.implode(',',$allowded).') ORDER BY `first_name` ASC');
        }else{
            $query = $this->db->query('SELECT * FROM `bg_users` as `a` LEFT JOIN `bg_messages` as `b` ON `a`.`user_id` = `b`.`sender` OR `a`.`user_id` = `b`.`reciver` WHERE `user_id` != ' . $_SESSION['user_id'] . ' ORDER BY `first_name` ASC');
        }
//        return $this->db->last_query();
        $latest = array();
        $used = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $result) {
                if (!in_array($result->user_id, $used)) {
                    $used[] = $result->user_id;
                    $latest[] = $result;
                }
            }
            return $latest;
        }
        return false;
    }



    public function getAllGroups(){
        if($_SESSION['user_type'] == 1) {
            $query = $this->db->query('SELECT * FROM `bg_msg_groups`');
        }else{
            $query = $this->db->query('SELECT * FROM '.TABLE_PRE.'msg_groups a LEFT JOIN '.TABLE_PRE.'msg_group_users b ON a.group_id = b.group_id WHERE b.user_id='.$_SESSION['user_id'].'');
        }
//        return $this->db->last_query();
        $latest = array();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getGroupById($gid){
        $query = $this->db->query('SELECT * FROM `bg_msg_groups` WHERE group_id='.$gid.' ');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function getGroupUsersByGroup($gid){
        $this->db->where('group_id',$gid);
        $this->db->select('*')->from(TABLE_PRE.'msg_group_users a');
        $this->db->join(TABLE_PRE.'users b','a.user_id = b.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function isAdminGroup($uid,$gid){
        $this->db->where('user_id',$uid);
        $this->db->where('group_id',$gid);
        $this->db->where('is_admin',1);
        $this->db->select('*')->from(TABLE_PRE.'msg_group_users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }
        return false;
    }

    public function hasGroupName($name,$gid = 0){
        if($gid != 0){
            $this->db->where('group_id !=',$gid);
        }
        $this->db->where('group_name',$name);
        $this->db->select('*')->from(TABLE_PRE.'msg_groups');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }
        return false;
    }

    // GROUPED MESSAGES DATES
    public function grouped_message($userid,$projectid){
        if($userid == 0) {
            $sql = "SELECT DATE(datetime) cdate FROM bg_discussions as messages WHERE (project_id=" . $projectid . " and reciver = 0) GROUP BY DATE(messages.datetime) order by datetime asc";
        }else{
            $sql = "SELECT DATE(datetime) cdate FROM bg_discussions as a WHERE ((sender=" . $_SESSION['user_id'] . " and reciver = " . $userid . ") or (sender=" . $userid . " and reciver = " . $_SESSION['user_id'] . ")) AND project_id=".$projectid."  GROUP BY DATE(a.datetime) order by datetime asc";
        }
        $query = $this->db->query($sql);
        return $messagedetail = $query->result_array();
    }

    // GETTING MESSAGE LIST BASED ON GROUP DATE
    function messagelist($userid, $pid, $date)
    {
        if($userid == 0){
            $sql = "SELECT *,DATE(datetime) as cdate FROM bg_discussions as message WHERE (project_id=".$pid." and reciver= 0) AND DATE_FORMAT(datetime,'%Y-%m-%d') = '" . $date . "'  order by datetime asc";
        }else {
            $sql = "SELECT *,DATE(datetime) as cdate FROM bg_discussions as message WHERE ((sender=" . $_SESSION['user_id'] . " and reciver= " . $userid . ") or (sender=" . $userid . " and reciver = " . $_SESSION['user_id'] . ")) AND DATE_FORMAT(datetime,'%Y-%m-%d') = '" . $date . "' AND project_id='".$pid."'  order by datetime asc";
        }
        $query = $this->db->query($sql);
        // return $this->db->last_query();
        return $messagedetail = $query->result_array();
    }

    // SEARCH USERS AND GROUPS
    function sortFunctionName( $a, $b ) {
        return strcmp($a["name"], $b["name"]);;
    }

    public function searchRes($seval,$pid,$clid){
        $cquery = $this->db->select('user_id,first_name,last_name,profile_img')->from(TABLE_PRE.'users')->where('user_id',$clid);
        $cquery = $this->db->get()->row_array();
        $cquery['project_id'] = $pid;

        if($_SESSION['user_id'] != 1) {
            $aquery = $this->db->select('user_id,first_name,last_name,profile_img')->from(TABLE_PRE . 'users')->where('user_id', 1);
            $aquery = $this->db->get()->row_array();
            $aquery['project_id'] = $pid;
        }

        $this->db->select('a.project_id,a.user_id,b.first_name,b.last_name,b.profile_img')->from('bg_project_users as a');
        $this->db->join(TABLE_PRE.'users as b','a.user_id = b.user_id');
        $this->db->where('a.project_id',$pid);
        $this->db->where('a.user_id !=',$_SESSION['user_id']);
        $query = $this->db->get();
        if($query->num_rows() > 0) {
            $result = $query->result_array();
            $result[] = $cquery;
            if($_SESSION['user_id'] != 1) { $result[] = $aquery; }
            $ures = array();
            foreach ($result as $res){
                $this->db->where('sender ='.$res['user_id'].' OR reciver ='.$res['user_id'].'');
                $this->db->where('project_id',$pid);
                $this->db->select('*')->from('bg_discussions')->order_by('datetime','DESC');
                $dqry = $this->db->get();
                $msg  = '';
                if($dqry->num_rows() > 0){
                    $msg = $dqry->row_array();
                }
                $ures[] = array(
                    'project_id'    => $pid,
                    'user_id'       => $res['user_id'],
                    'first_name'    => $res['first_name'],
                    'last_name'     => $res['last_name'],
                    'profile_img'   => $res['profile_img'],
                    'message'       => (isset($msg['message'])?$msg['message']:''),
                    'datetime'      => (isset($msg['datetime'])?$msg['datetime']:'0000-00-00 00:00:00'),
                );
            }
            usort($ures, array("Discussion_model", "sortFunction"));
            return array_reverse($ures);
        }
        return false;
    }

    public function getAllUsersBySearch($seval){
        if($_SESSION['user_type'] == 2) {
            $allowded = array(1);
            $query = $this->db->query('SELECT * FROM `bg_users` as `a` WHERE `user_id` != ' . $_SESSION['user_id'] . ' AND (first_name LIKE "%'.$seval.'%" || last_name LIKE "%'.$seval.'%") AND user_id IN ('.implode(',',$allowded).') ORDER BY `first_name` ASC');
        }else{
            $query = $this->db->query('SELECT * FROM `bg_users` as `a` WHERE `user_id` != ' . $_SESSION['user_id'] . ' AND (first_name LIKE "%'.$seval.'%" || last_name LIKE "%'.$seval.'%") ORDER BY `first_name` ASC');
        }
        $latest = array();
        if($query->num_rows() > 0){
            foreach ($query->result() as $result){
                $latest[] = array(
                    'gu_id'     => $result->user_id,
                    'is_group'  => 0,
                    'name'      => $result->first_name.' '.$result->last_name,
                    'img'       => $result->profile_img,
                );
            }
            return $latest;
        }
        return false;
    }

    public function getAllGroupsBySearch($seval){
        if($_SESSION['user_type'] == 1) {
            $query = $this->db->query('SELECT * FROM `bg_msg_groups` WHERE group_name LIKE "%'.$seval.'%"');
        }else{
            $query = $this->db->query('SELECT * FROM '.TABLE_PRE.'msg_groups a LEFT JOIN '.TABLE_PRE.'msg_group_users b ON a.group_id = b.group_id WHERE b.user_id='.$_SESSION['user_id'].' AND group_name LIKE "%'.$seval.'%" ');
        }
//        return $this->db->last_query();
        $latest = array();
        if($query->num_rows() > 0){
            foreach ($query->result_array() as $grp){
                $latest[] = array(
                    'gu_id'     => $grp['group_id'],
                    'is_group'  => 1,
                    'name'      => $grp['group_name'],
                    'img'       => $grp['group_img'],
                );
            }
            return $latest;
        }
        return false;
    }

}