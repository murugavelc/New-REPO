<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function allTasks(){
        $this->db->select('a.*,b.project_name,c.first_name as cfirst,c.last_name as clast,d.first_name as afirst,d.last_name as alast')->from(TABLE_PRE.'tasks as a');
        $this->db->join(TABLE_PRE.'projects as b','a.project_id = b.project_id');
        $this->db->join(TABLE_PRE.'users as c','a.created_by = c.user_id');
        $this->db->join(TABLE_PRE.'users as d','a.assigned_to = d.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allClientTasks($id){
        $this->db->where('created_by',$id);
        $this->db->select('a.*,b.project_name,c.first_name as cfirst,c.last_name as clast,d.first_name as afirst,d.last_name as alast')->from(TABLE_PRE.'tasks as a');
        $this->db->join(TABLE_PRE.'projects as b','a.project_id = b.project_id');
        $this->db->join(TABLE_PRE.'users as c','a.created_by = c.user_id');
        $this->db->join(TABLE_PRE.'users as d','a.assigned_to = d.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allStaffTasks($id){
        $pq = $this->db->select('project_id')->from(TABLE_PRE.'project_users')->where('user_id',$id)->get();
        if($pq->num_rows() > 0){
            $twoDimensionalArray = $pq->result_array();
            $oneDimensionalArray = array_map('current', $twoDimensionalArray);
        }

        $this->db->where('assigned_to',$id);
        $this->db->where_in('a.project_id',$oneDimensionalArray);
        $this->db->select('a.*,b.project_name,c.first_name as cfirst,c.last_name as clast,d.first_name as afirst,d.last_name as alast')->from(TABLE_PRE.'tasks as a');
        $this->db->join(TABLE_PRE.'projects as b','a.project_id = b.project_id');
        $this->db->join(TABLE_PRE.'users as c','a.created_by = c.user_id');
        $this->db->join(TABLE_PRE.'users as d','a.assigned_to = d.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }
    public function getTaskById($id){
        $this->db->where('task_id',$id);
        $this->db->select('a.*,b.project_name,c.first_name as cfirst,c.last_name as clast,d.first_name as afirst,d.last_name as alast,c.profile_img,d.profile_img as aimg')->from(TABLE_PRE.'tasks as a');
        $this->db->join(TABLE_PRE.'projects as b','a.project_id = b.project_id');
        $this->db->join(TABLE_PRE.'users as c','a.created_by = c.user_id');
        $this->db->join(TABLE_PRE.'users as d','a.assigned_to = d.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function getTasksByProject($id){
        $this->db->where('a.project_id',$id);
        $asmeot = TRUE;
        if(isset($_SESSION['task_filter'])){
            switch ($_SESSION['task_filter']){
                case 'all':
//                    $this->db->where('(a.status != 3 AND a.status != 5)');
                    break;
                case 'due_today':
                    $this->db->where('due_on = "'.date('Y-m-d',strtotime('now')).'"');
                    break;
                case 'past_due':
                    $this->db->where('due_on <= "'.date('Y-m-d',strtotime('now')).'" AND (a.status != 3 AND a.status != 5)');
                    break;
                case 'completed':
                    $this->db->where('a.status',3);
                    break;
                case 'closed':
                    $this->db->where('a.status',5);
                    break;
                case 'assignedme':
                    $asmeot = FALSE;
                    $this->db->where('assigned_to = '.$_SESSION['user_id'].'');
                    break;
                case 'assignedothers':
                    $asmeot = FALSE;
                    $this->db->where('created_by ='.$_SESSION['user_id']);
                    break;
            }
        }else{
//            $this->db->where('(a.status != 3 AND a.status != 5)');
        }
        if($_SESSION['user_type'] != 1 AND $asmeot == TRUE){
            $this->db->where('(assigned_to = '.$_SESSION['user_id'].' OR created_by ='.$_SESSION['user_id'].')');
        }
        $this->db->select('a.*,b.project_name,c.first_name as cfirst,c.last_name as clast,d.first_name as afirst,d.last_name as alast,c.profile_img,d.profile_img as aimg')->from(TABLE_PRE.'tasks as a');
        $this->db->join(TABLE_PRE.'projects as b','a.project_id = b.project_id');
        $this->db->join(TABLE_PRE.'users as c','a.created_by = c.user_id');
        $this->db->join(TABLE_PRE.'users as d','a.assigned_to = d.user_id');
        $this->db->order_by('due_on','DESC');
        $query = $this->db->get();
//        print_r($this->db->last_query());
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getTasksStatusByProject($id){
        global $TASK_STATUS;
        $TaskStatus = array();
        foreach ($TASK_STATUS as $key => $status){
            $count = $this->getCountTaskStatus($id,$key);
            $TaskStatus[$status] = $count;
        }
        return $TaskStatus;
    }

    public function getCountTaskStatus($pid,$status){
        $this->db->where('project_id',$pid);
        $this->db->where('status',$status);
        if($_SESSION['user_id'] != 1) {
            $this->db->where('assigned_to =' . $_SESSION['user_id'] . ' OR created_by=' . $_SESSION['user_id'] . '');
        }
        return $this->db->count_all_results(TABLE_PRE.'tasks');
    }

    public function getRecentsTasksByProject($id){
        $this->db->where('a.project_id',$id);
        $this->db->where('a.status != 3 AND a.status != 5');
        $this->db->where('a.due_on < "'.date('Y-m-d',strtotime('now')).'"');
        if($_SESSION['user_type'] != 1){
            $this->db->where('assigned_to = '.$_SESSION['user_id'].'');
        }
        $this->db->select('a.*,b.project_name,c.first_name as cfirst,c.last_name as clast,d.first_name as afirst,d.last_name as alast,c.profile_img,d.profile_img as aimg')->from(TABLE_PRE.'tasks as a');
        $this->db->join(TABLE_PRE.'projects as b','a.project_id = b.project_id');
        $this->db->join(TABLE_PRE.'users as c','a.created_by = c.user_id');
        $this->db->join(TABLE_PRE.'users as d','a.assigned_to = d.user_id')->order_by('due_on','ASC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function hasTaskName($name,$id=''){
        if($id != ''){
            $this->db->where('task_id !=',$id);
        }
        $this->db->where('title',$name);
        $query = $this->db->select('*')->from(TABLE_PRE.'tasks')->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function totalTasks($pid){
        $this->db->where('project_id',$pid);
        return $this->db->count_all_results(TABLE_PRE.'tasks');
    }

    public function getTaskComments($id,$pid)
    {
        $this->db->where('task_id',$id);
        $this->db->where('project_id',$pid);
        $this->db->select('a.*,b.first_name as first,b.last_name as last,b.profile_img')->from(TABLE_PRE.'task_comments as a');
        $this->db->join(TABLE_PRE.'users as b','a.user_id = b.user_id');
        $this->db->order_by('created_on','asc');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getStatusView($status){
        global $TASK_STATUS;
        switch($TASK_STATUS[$status]){
            case 'Open':
                return '<span class="label label-primary">Open</span>';
                break;
            case 'Progress':
                return '<span class="label label-info bg-info-800">Progress</span>';
                break;
            case 'Completed':
                return '<span class="label label-success">Completed</span>';
                break;
            case 'Reopen':
                return '<span class="label label-danger">Reopen</span>';
                break;
            case 'Closed':
                return '<span class="label label-success bg-slate-800">Closed</span>';
                break;
        }
    }

}