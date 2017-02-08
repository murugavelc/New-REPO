<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function allProjects(){
        if(isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] != 'all'){
            $this->db->where('status',$_SESSION['pro_filter']);
        }else {
            $this->db->where('status != 0');
        }
        $this->db->select('a.*,b.first_name as client_first,b.last_name as client_last')->from(TABLE_PRE.'projects as a');
        $this->db->join(TABLE_PRE.'users as b','a.client_id = b.user_id');
        if(isset($_SESSION['pro_sort'])){
            switch ($_SESSION['pro_sort']){
                case 'name_asc':
                    $this->db->order_by('a.project_name','ASC');
                    break;
                case 'name_desc':
                    $this->db->order_by('a.project_name','DESC');
                    break;
                case 'act_asc':
                    $this->db->order_by('a.updated_on','ASC');
                    break;
                case 'act_desc':
                    $this->db->order_by('a.updated_on','DESC');
                    break;
            }
        }else {
            $this->db->order_by('a.project_name','ASC');
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allClientProjects($id){
        if(isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] != 'all'){
            $this->db->where('status',$_SESSION['pro_filter']);
        }else {
            $this->db->where('status != 0');
        }
        $this->db->where('client_id',$id);
        $this->db->select('a.*,b.first_name as client_first,b.last_name as client_last')->from(TABLE_PRE.'projects as a');
        $this->db->join(TABLE_PRE.'users as b','a.client_id = b.user_id');
        if(isset($_SESSION['pro_sort'])){
            switch ($_SESSION['pro_sort']){
                case 'name_asc':
                    $this->db->order_by('a.project_name','ASC');
                    break;
                case 'name_desc':
                    $this->db->order_by('a.project_name','DESC');
                    break;
                case 'act_asc':
                    $this->db->order_by('a.updated_on','ASC');
                    break;
                case 'act_desc':
                    $this->db->order_by('a.updated_on','DESC');
                    break;
            }
        }else {
            $this->db->order_by('a.project_name','ASC');
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function allStaffProjects($id){
        $pq = $this->db->select('project_id')->from(TABLE_PRE.'project_users')->where('user_id',$id)->get();
        if($pq->num_rows() > 0){
            $twoDimensionalArray = $pq->result_array();
            $oneDimensionalArray = array_map('current', $twoDimensionalArray);
        }
        if(isset($_SESSION['pro_filter']) && $_SESSION['pro_filter'] != 'all'){
            $this->db->where('status',$_SESSION['pro_filter']);
        }else {
            $this->db->where('status != 0');
        }
        $this->db->where_in('project_id',$oneDimensionalArray);
        $this->db->select('a.*,b.first_name as client_first,b.last_name as client_last')->from(TABLE_PRE.'projects as a');
        $this->db->join(TABLE_PRE.'users as b','a.client_id = b.user_id');
        if(isset($_SESSION['pro_sort'])){
            switch ($_SESSION['pro_sort']){
                case 'name_asc':
                    $this->db->order_by('a.project_name','ASC');
                    break;
                case 'name_desc':
                    $this->db->order_by('a.project_name','DESC');
                    break;
                case 'act_asc':
                    $this->db->order_by('a.updated_on','ASC');
                    break;
                case 'act_desc':
                    $this->db->order_by('a.updated_on','DESC');
                    break;
            }
        }else {
            $this->db->order_by('a.project_name','ASC');
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function ProjectUsers($pid){
        $this->db->where('a.project_id',$pid);
        $this->db->select('*')->from(TABLE_PRE.'project_users as a');
        $this->db->join(TABLE_PRE.'users as b','a.user_id = b.user_id');
        $this->db->join(TABLE_PRE.'user_types as c','b.user_type = c.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function ProjectUserIds($pid){
        $this->db->where('a.project_id',$pid);
        $this->db->select('a.user_id')->from(TABLE_PRE.'project_users as a');
        $this->db->join(TABLE_PRE.'users as b','a.user_id = b.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return array_column($query->result_array(),'user_id');
        }
        return false;
    }

    public function getProjectById($id){

            $this->db->where('status != 0');
        $this->db->where('project_id',$id);
        $this->db->select('a.*,b.first_name as client_first,b.last_name as client_last')->from(TABLE_PRE.'projects as a');
        $this->db->join(TABLE_PRE.'users as b','a.client_id = b.user_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function hasProjectName($name,$id=''){
        if($id != ''){
            $this->db->where('project_id !=',$id);
        }
        $this->db->where('project_name',$name);
        $query = $this->db->select('*')->from(TABLE_PRE.'projects')->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

}