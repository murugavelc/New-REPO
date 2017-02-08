<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllRoles(){
        $this->db->select('type_id,name')->from(TABLE_PRE.'user_types');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getUserById($id,$type){
        $this->db->where('user_id',$id);
        $this->db->where('user_type',$type);
        $this->db->select('*')->from(TABLE_PRE.'users as a');
        $this->db->join(TABLE_PRE.'user_types as b','a.user_type = b.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function getRolesById($id){
        $this->db->where('a.type_id',$id);
        $this->db->select('*')->from(TABLE_PRE.'user_types as a');
        $this->db->join(TABLE_PRE.'user_privilages as b','a.type_id = b.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function privilagesAll($role = array()){
        if(!empty($role)){
            $count = count($role)*4;
            $total = '';
            foreach ($role as $priv){
                $total += $priv->padd+$priv->pview+$priv->pedit+$priv->pdelete;
            }
            if($count == $total){
                return true;
            }
            return false;
        }
    }

    public function hasrolename($name,$id = 0){
        if($id != 0){
            $query = $this->db->select('name')->from(TABLE_PRE.'user_types')->where('name',$name)->where('type_id !=',$id)->get();
            if($query->num_rows() > 0){
                return true;
            }
            return false;
        }else{
            $query = $this->db->select('name')->from(TABLE_PRE.'user_types')->where('name',$name)->get();
            if($query->num_rows() > 0){
                return true;
            }
            return false;
        }
    }

}