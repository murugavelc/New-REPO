<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function check_login($email,$pass,$user_type = ''){
        $this->db->where('email',$email);
        $this->db->where('password',md5($pass));
        if($user_type != '') {
            $this->db->where('user_type =' . $user_type . '');
        }else{
            $this->db->where('user_type != 4');
        }
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function allUsers($type){

            $this->db->where('user_type', $type);
        
        $this->db->where('is_deleted != 1');
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function getAllUsersEmail($type){
        $this->db->where('user_type', $type);
        $this->db->where('is_deleted != 1');
        $this->db->select('email')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return array_column($query->result_array(),'email');
        }
        return false;
    }

    public function getUserById($id,$type){
        $this->db->where('user_id',$id);
        $this->db->where('user_type',$type);
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function getUserDetById($id){
        $this->db->where('user_id',$id);
        $this->db->select('*')->from(TABLE_PRE.'users as a');
//        $this->db->join(TABLE_PRE.'user_types as b','a.user_type = b.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }
        return false;
    }

    public function UsersByType($type){
        $this->db->where('user_type',$type);
        $this->db->select('*')->from(TABLE_PRE.'users');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function StaffUsers(){
        $this->db->where('user_type !=',2);
        $this->db->where('user_type !=',1);
        $this->db->select('a.*,b.name')->from(TABLE_PRE.'users as a');
        $this->db->join(TABLE_PRE.'user_types as b','a.user_type = b.type_id');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

    public function hasEmail($email,$id = ''){
        if($id != ''){
            $this->db->where('user_id !=',$id);
        }
        $this->db->where('email',$email);
        $query = $this->db->select('*')->from(TABLE_PRE.'users')->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
   public function edit_myaccount($user_id)
       {
		   $this->db->select('*');
		   $this->db->from('sv_users');
		   $this->db->where('user_id',$user_id);
		   $edit_result=$this->db->get();
		   return $edit_result->result_array();
       }

  public function update_myaccount($data)
       {
		   $id=$_SESSION['user_id']; 
		   $this->db->where('user_id', $id);
		   $result=$this->db->update('sv_users', $data);
       }
  public function forget_password($old_password,$new_password)
       {
		   $user_ids=$_SESSION['user_id'];
		   $where=array('user_id'=>$user_ids,"password"=>md5($old_password));
		   $data=array("password"=>md5($new_password));
		   $this->db->select('*');
		   $this->db->from('sv_users');
		   $this->db->where($where);
		   $result=$this->db->get();
		   $count=$result->num_rows();
		   if ($count==1)
		   {
			 $this->db->where($where);
			 $this->db->update("sv_users",$data);
			 return 1;
			}
		   else{
			return 0;
		   }
       }
       public function get_states($country_id)
       {
       $this->db->select('*');
       $this->db->from('sv_states');
       $this->db->where('country_id',$country_id);
       $result=$this->db->get();
       return $result->result_array();    
       
       }
       public function getcitie($state_id)
       {
			$this->db->select('*');
			$this->db->from('sv_cities');
			$this->db->where('state_id',$state_id);
			$cites=$this->db->get();
			return $cites->result_array(); 
       }
	   public function forgotpass($email)
        {
			$this->db->select('*');
			$this->db->from('sv_users');
			$this->db->where('email',$email);
			$query=$this->db->get();
			$user = $query->result_array();
			
			if($query->num_rows()>0)
			{
				$random_number=rand();
				$key=md5($random_number);
				$value=array('password'=>$key);
				$this->db->where('email',$email); 
				$this->db->update('sv_users',$value);
				$data['subj'] = 'Salvage :: Forget Password';
			    $data['password'] = $random_number;
				//$data['user'] = $user;
				$data['username'] = $user[0]['first_name'].' '.$user[0]['last_name'];
			    $email_msg = $this->load->view('email/forget_password', $data, true);
			    email_sender($email, $data['subj'], $email_msg);
				return 1;
			}
			else{
			 return 0;
			}
        }
}